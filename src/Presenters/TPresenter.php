<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\Presenters;

use GrandMedia\AdminLTE\Components\ContentHeaderFactory;
use GrandMedia\AdminLTE\Components\FooterFactory;
use GrandMedia\AdminLTE\Components\HeaderFactory;
use GrandMedia\AdminLTE\Components\SidebarFactory;
use GrandMedia\Widgets\Widget;

trait TPresenter
{

	/** @var \GrandMedia\AdminLTE\Components\HeaderFactory */
	protected $headerFactory;

	/** @var \GrandMedia\AdminLTE\Components\SidebarFactory */
	protected $sidebarFactory;

	/** @var \GrandMedia\AdminLTE\Components\ContentHeaderFactory */
	protected $contentHeaderFactory;

	/** @var \GrandMedia\AdminLTE\Components\FooterFactory */
	protected $footerFactory;

	public function injectFactories(
		HeaderFactory $headerFactory,
		SidebarFactory $sidebarFactory,
		ContentHeaderFactory $contentHeaderFactory,
		FooterFactory $footerFactory
	): void
	{
		$this->headerFactory = $headerFactory;
		$this->sidebarFactory = $sidebarFactory;
		$this->contentHeaderFactory = $contentHeaderFactory;
		$this->footerFactory = $footerFactory;
	}

	protected function createComponentHeader(): Widget
	{
		return $this->headerFactory->create();
	}

	protected function createComponentSidebar(): Widget
	{
		return $this->sidebarFactory->create();
	}

	protected function createComponentContentHeader(): Widget
	{
		return $this->contentHeaderFactory->create();
	}

	protected function createComponentFooter(): Widget
	{
		return $this->footerFactory->create();
	}

}
