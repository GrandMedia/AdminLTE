<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\DI;

use GrandMedia\AdminLTE\Components\ContentHeaderFactory;
use GrandMedia\AdminLTE\Components\FooterFactory;
use GrandMedia\AdminLTE\Components\HeaderFactory;
use GrandMedia\AdminLTE\Components\MainMenuFactory;
use GrandMedia\AdminLTE\Components\NavigationBarFactory;
use GrandMedia\AdminLTE\Components\NavigationBarMenuFactory;
use GrandMedia\AdminLTE\Components\SidebarFactory;
use GrandMedia\Widgets\Item;
use GrandMedia\Widgets\Items;
use Nette\DI\Statement;

final class AdminLTEExtension extends \Nette\DI\CompilerExtension
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
	}

}
