<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\DI;

use GrandMedia\AdminLTE\Components\MainMenuFactory;
use GrandMedia\AdminLTE\Components\TopBarFactory;
use GrandMedia\Widgets\Components;

final class AdminLTEExtension extends \Nette\DI\CompilerExtension
{

	/**
	 * @var mixed[]
	 */
	private $defaults = [
		'mainMenu' => [],
		'topBar' => [],
	];

	public function loadConfiguration(): void
	{
		$config = $this->validateConfig($this->defaults);
		$containerBuilder = $this->getContainerBuilder();

		//Components
		$widgets = [
			'mainMenu' => MainMenuFactory::class,
			'topBar' => TopBarFactory::class,
		];

		foreach ($widgets as $name => $class) {
			$components = $containerBuilder->addDefinition($name . 'Components')
				->setType(Components::class)
				->setAutowired(false);
			foreach ($config[$name] as $component) {
				$components->addSetup('add', [$component[0], $component[1]]);
			}

			$containerBuilder->addDefinition($this->prefix($name . 'Factory'))
				->setFactory($class, [$components]);
		}
	}

}
