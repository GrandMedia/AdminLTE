<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\DI;

use GrandMedia\AdminLTE\Components\MainMenuFactory;
use GrandMedia\AdminLTE\Components\NavigationBarMenuFactory;
use GrandMedia\Widgets\Items;

final class AdminLTEExtension extends \Nette\DI\CompilerExtension
{

	public function loadConfiguration(): void
	{
		$containerBuilder = $this->getContainerBuilder();

		//Components
		$components = [
			'mainMenu' => MainMenuFactory::class,
			'navigationBarMenu' => NavigationBarMenuFactory::class,
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
