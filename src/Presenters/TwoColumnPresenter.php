<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\Presenters;

use GrandMedia\AdminLTE\Components\MainMenuWidgetFactory;
use GrandMedia\AdminLTE\Components\TopBarWidgetFactory;
use GrandMedia\Widgets\Widget;

trait TwoColumnPresenter
{

	/**
	 * @var \GrandMedia\AdminLTE\Components\MainMenuWidgetFactory
	 */
	protected $mainMenuWidgetFactory;

	/**
	 * @var \GrandMedia\AdminLTE\Components\TopBarWidgetFactory
	 */
	protected $topBarWidgetFactory;

	/**
	 * @var string
	 */
	protected $baseLayout = __DIR__ . '/templates/@twoColumn.layout.latte';

	public function injectFactories(
		MainMenuWidgetFactory $mainMenuWidgetFactory,
		TopBarWidgetFactory $topBarWidgetFactory
	): void
	{
		$this->mainMenuWidgetFactory = $mainMenuWidgetFactory;
		$this->topBarWidgetFactory = $topBarWidgetFactory;
	}

	protected function createComponentMainMenuWidget(): Widget
	{
		return $this->mainMenuWidgetFactory->create();
	}

	protected function createComponentTopBarWidget(): Widget
	{
		return $this->topBarWidgetFactory->create();
	}

}
