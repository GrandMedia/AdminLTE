<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\Forms;

use Nette\Application\UI\Form;
use Nette\Localization\ITranslator;

final class FormFactory
{

	/** @var \Nette\Localization\ITranslator */
	private $translator;

	public function __construct(ITranslator $translator)
	{
		$this->translator = $translator;
	}

	public function create(): Form
	{
		$form = new Form();

		$form->setTranslator($this->translator);
		$form->setRenderer(new HorizontalFormRenderer());
		$form->getElementPrototype()->setAttribute('class', 'form-horizontal');

		return $form;
	}

}
