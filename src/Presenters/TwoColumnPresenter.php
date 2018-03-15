<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\Presenters;

use GrandMedia\AdminLTE\Components\MainMenuWidgetFactory;
use GrandMedia\AdminLTE\Components\TopBarWidgetFactory;
use GrandMedia\Widgets\Widget;

trait TwoColumnPresenter
{

	/** @var \GrandMedia\AdminLTE\Components\MainMenuWidgetFactory */
	protected $mainMenuFactory;

	/** @var \GrandMedia\AdminLTE\Components\TopBarWidgetFactory */
	protected $navigationBarMenuFactory;

	/** @var string */
	protected $baseLayout = __DIR__ . '/templates/@twoColumn.layout.latte';

	public function injectFactories(
		MainMenuWidgetFactory $mainMenuFactory,
		TopBarWidgetFactory $navigationBarMenuFactory
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
