<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\Presenters;

use GrandMedia\AdminLTE\Components\MainMenuFactory;
use GrandMedia\AdminLTE\Components\TopBarFactory;
use GrandMedia\Widgets\Widget;

trait TwoColumnPresenter
{

	/**
	 * @var \GrandMedia\AdminLTE\Components\MainMenuFactory
	 */
	protected $mainMenuFactory;

	/**
	 * @var \GrandMedia\AdminLTE\Components\TopBarFactory
	 */
	protected $topBarFactory;

	/**
	 * @var string
	 */
	protected $baseLayout = __DIR__ . '/templates/@twoColumn.layout.latte';

	public function injectFactories(
		MainMenuFactory $mainMenuFactory,
		TopBarFactory $topBarFactory
	): void
	{
		$this->mainMenuFactory = $mainMenuFactory;
		$this->topBarFactory = $topBarFactory;
	}

	protected function createComponentMainMenu(): Widget
	{
		return $this->mainMenuFactory->create();
	}

	protected function createComponentTopBar(): Widget
	{
		return $this->topBarFactory->create();
	}

}
