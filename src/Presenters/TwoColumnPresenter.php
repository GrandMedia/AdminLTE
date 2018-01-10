<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\Presenters;

use GrandMedia\AdminLTE\Components\MainMenuFactory;
use GrandMedia\AdminLTE\Components\NavigationBarMenuFactory;
use GrandMedia\Widgets\Widget;

trait TwoColumnPresenter
{

	/** @var \GrandMedia\AdminLTE\Components\MainMenuFactory */
	protected $mainMenuFactory;

	/** @var \GrandMedia\AdminLTE\Components\NavigationBarMenuFactory */
	protected $navigationBarMenuFactory;

	/** @var string */
	protected $baseLayout = __DIR__ . '/templates/@twoColumn.layout.latte';

	public function injectFactories(
		MainMenuFactory $mainMenuFactory,
		NavigationBarMenuFactory $navigationBarMenuFactory
	): void
	{
		$this->mainMenuFactory = $mainMenuFactory;
		$this->navigationBarMenuFactory = $navigationBarMenuFactory;
	}

	protected function createComponentMainMenu(): Widget
	{
		return $this->mainMenuFactory->create();
	}

	protected function createComponentNavigationBarMenu(): Widget
	{
		return $this->navigationBarMenuFactory->create();
	}

}
