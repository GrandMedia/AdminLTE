<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\Forms;

use Nette\Forms\Controls\BaseControl;
use Nette\Forms\IControl;
use Nette\Utils\Html;
use Nette\Utils\IHtmlString;

final class HorizontalFormRenderer extends \Nette\Forms\Rendering\DefaultFormRenderer
{

	public function __construct()
	{
		$this->wrappers['controls']['container'] = 'div class=box-body';
		$this->wrappers['pair']['container'] = 'div class="form-group"';
		$this->wrappers['pair']['.error'] = 'has-error';
		$this->wrappers['control']['container'] = 'div class="col-sm-10"';
		$this->wrappers['label']['container'] = null;
		$this->wrappers['control']['description'] = 'span class=help-block';
		$this->wrappers['control']['errorcontainer'] = 'span class=help-block';
		$this->wrappers['control']['.text'] = 'form-control text';
		$this->wrappers['control']['.password'] = 'form-control text';
		$this->wrappers['control']['.file'] = 'form-control text';
		$this->wrappers['control']['.email'] = 'form-control text';
		$this->wrappers['control']['.number'] = 'form-control text';
		$this->wrappers['control']['.submit'] = 'btn btn-info';
		$this->wrappers['control']['.image'] = 'btn imagebutton';
		$this->wrappers['control']['.button'] = 'btn btn-info';
	}

	public function renderLabel(IControl $control): Html
	{
		$label = '';

		if ($control instanceof BaseControl) {
			$suffix = $this->getValue('label suffix') .
				($control->isRequired() ? $this->getValue('label requiredsuffix') : '');
			$label = $control->getLabel();
			if ($label instanceof Html) {
				$label->setAttribute('class', 'col-sm-2 control-label');

				$label->addHtml($suffix);
				if ($control->isRequired()) {
					$label->appendAttribute('class', $this->getValue('control .required'), true);
				}
			} else {
				$label .= $suffix;
			}
		}

		return $this->getWrapper('label container')->setHtml($label);
	}

	public function renderControl(IControl $control): Html
	{
		$body = $this->getWrapper('control container');
		if ($this->counter % 2) {
			$body->appendAttribute('class', $this->getValue('control .odd'), true);
		}

		$el = '';
		$description = '';
		if ($control instanceof BaseControl) {
			$description = $control->getOption('description');
			if ($description instanceof IHtmlString) {
				$description = ' ' . $description;
			} elseif (\is_string($description)) {
				$description = $control->translate($description);
				$description = ' ' . $this->getWrapper('control description')->setText($description);
			}

			if ($control->isRequired()) {
				$description = $this->getValue('control requiredsuffix') . $description;
			}

			$control->setOption('rendered', true);
			$el = $control->getControl();
			if ($el instanceof Html) {
				if ($el->getName() === 'input') {
					$el->appendAttribute('class', $this->getValue('control .' . $el->getAttribute('type')), true);
				} elseif ($el->getName() === 'select') {
					$el->appendAttribute('class', 'form-control', true);
				}
			}
		}

		return $body->setHtml($el . $description . $this->renderErrors($control));
	}

}
