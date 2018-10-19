<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\Components;

use Assert\Assertion;

final class Breadcrumb extends \Nette\Application\UI\Control
{

	/**
	 * @var string
	 */
	private $icon;

	/**
	 * @var \GrandMedia\AdminLTE\Components\Link[]
	 */
	private $links = [];

	/**
	 * @param \GrandMedia\AdminLTE\Components\Link[] $links
	 */
	public function __construct(string $icon, array $links)
	{
		parent::__construct();

		Assertion::notBlank($icon);
		Assertion::allIsInstanceOf($links, Link::class);

		$this->icon = $icon;
		$this->links = $links;
	}

	public function render(): void
	{
		/** @var \Nette\Bridges\ApplicationLatte\Template $template */
		$template = $this->getTemplate();
		$template->setFile(__DIR__ . '/templates/breadcrumb.latte');

		$template->setParameters(
			[
				'icon' => $this->icon,
				'links' => $this->links,
			]
		);

		$template->render();
	}

}
