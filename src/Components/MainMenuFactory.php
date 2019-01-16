<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\Components;

use GrandMedia\Widgets\Components;
use GrandMedia\Widgets\Widget;

final class MainMenuFactory
{

	/**
	 * @var \GrandMedia\Widgets\Components
	 */
	private $components;

	public function __construct(Components $components)
	{
		$this->components = $components;
	}

	public function create(): Widget
	{
		return new Widget($this->components, __DIR__ . '/templates/mainMenu.latte');
	}

}
