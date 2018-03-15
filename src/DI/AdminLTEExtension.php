<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\DI;

use GrandMedia\AdminLTE\Components\MainMenuWidgetFactory;
use GrandMedia\AdminLTE\Components\TopBarWidgetFactory;
use GrandMedia\Widgets\Items;

final class AdminLTEExtension extends \Nette\DI\CompilerExtension
{

	public function loadConfiguration(): void
	{
		$containerBuilder = $this->getContainerBuilder();

		//Components
		$components = [
			'mainMenu' => MainMenuWidgetFactory::class,
			'navigationBarMenu' => TopBarWidgetFactory::class,
		];

		foreach ($components as $name => $class) {
			$containerBuilder->addDefinition($name . 'Items')
				->setType(Items::class)
				->setAutowired(false);
			$containerBuilder->addDefinition($this->prefix($name . 'Factory'))
				->setFactory($class, ['@' . $name . 'Items']);
		}
	}

}
