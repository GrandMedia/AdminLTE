<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\Components;

use GrandMedia\Widgets\Items;
use GrandMedia\Widgets\Widget;

final class NavigationBarFactory
{

	/** @var \GrandMedia\Widgets\Items */
	private $items;

	public function __construct(Items $items)
	{
		$this->items = $items;
	}

	public function create(): Widget
	{
		return new Widget($this->items, __DIR__ . '/templates/navigationBar.latte');
	}

}
