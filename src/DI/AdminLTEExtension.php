<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\DI;

use GrandMedia\AdminLTE\Components\ContentHeaderFactory;
use GrandMedia\AdminLTE\Components\FooterFactory;
use GrandMedia\AdminLTE\Components\HeaderFactory;
use GrandMedia\AdminLTE\Components\MainMenuFactory;
use GrandMedia\AdminLTE\Components\NavigationBarFactory;
use GrandMedia\AdminLTE\Components\NavigationBarMenuFactory;
use GrandMedia\AdminLTE\Components\SidebarFactory;
use GrandMedia\AdminLTE\Forms\FormFactory;
use GrandMedia\Widgets\Item;
use GrandMedia\Widgets\Items;
use Nette\DI\Statement;
use Nette\Forms\Controls\SelectBox;
use Nette\Forms\Controls\UploadControl;
use Nette\Forms\Form;
use Nette\Forms\Validator;

final class AdminLTEExtension extends \Nette\DI\CompilerExtension implements \Kdyby\Translation\DI\ITranslationProvider
{

	public function loadConfiguration(): void
	{
		$containerBuilder = $this->getContainerBuilder();

		//Components
		$components = [
			'contentHeader' => ContentHeaderFactory::class,
			'footer' => FooterFactory::class,
			'header' => HeaderFactory::class,
			'mainMenu' => MainMenuFactory::class,
			'navigationBar' => NavigationBarFactory::class,
			'navigationBarMenu' => NavigationBarMenuFactory::class,
			'sidebar' => SidebarFactory::class,
		];

		foreach ($components as $name => $class) {
			$containerBuilder->addDefinition($name . 'Items')
				->setType(Items::class)
				->setAutowired(false);
			$containerBuilder->addDefinition($this->prefix($name . 'Factory'))
				->setFactory($class, ['@' . $name . 'Items']);
		}

		$containerBuilder->getDefinition('headerItems')
			->addSetup('add', [new Statement(Item::class, [10, ['@' . NavigationBarFactory::class, 'create']])]);

		$containerBuilder->getDefinition('navigationBarItems')
			->addSetup('add', [new Statement(Item::class, [10, ['@' . NavigationBarMenuFactory::class, 'create']])]);

		$containerBuilder->getDefinition('sidebarItems')
			->addSetup('add', [new Statement(Item::class, [10, ['@' . MainMenuFactory::class, 'create']])]);

		//Forms
		$containerBuilder->addDefinition($this->prefix('formFactory'))
			->setType(FormFactory::class);

		Validator::$messages = [
			Form::PROTECTION => 'form.error.validateCsrf',
			Form::EQUAL => 'form.error.equal',
			Form::NOT_EQUAL => 'form.error.notEqual',
			Form::FILLED => 'form.error.filled',
			Form::BLANK => 'form.error.blank',
			Form::MIN_LENGTH => 'form.error.minLength',
			Form::MAX_LENGTH => 'form.error.maxLength',
			Form::LENGTH => 'form.error.length',
			Form::EMAIL => 'form.error.email',
			Form::URL => 'form.error.url',
			Form::INTEGER => 'form.error.integer',
			Form::FLOAT => 'form.error.float',
			Form::MIN => 'form.error.min',
			Form::MAX => 'form.error.max',
			Form::RANGE => 'form.error.range',
			Form::MAX_FILE_SIZE => 'form.error.fileSize',
			Form::MAX_POST_SIZE => 'form.error.maxPostSize',
			Form::MIME_TYPE => 'form.error.mimeType',
			Form::IMAGE => 'form.error.image',
			SelectBox::VALID => 'form.error.selectBoxValid',
			UploadControl::VALID => 'form.error.uploadControlValid',
		];
	}

	/**
	 * @return string[]
	 */
	public function getTranslationResources(): array
	{
		return [
			__DIR__ . '/../translations',
		];
	}

}
