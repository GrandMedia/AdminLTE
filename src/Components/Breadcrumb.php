<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\Components;

use Assert\Assertion;

final class Breadcrumb extends \Nette\Application\UI\Control
{

	/** @var \GrandMedia\AdminLTE\Components\Link[] */
	private $links = [];

	public function render(): void
	{
		/** @var \Nette\Bridges\ApplicationLatte\Template $template */
		$template = $this->getTemplate();
		$template->setFile(__DIR__ . '/templates/breadcrumb.latte');

		$template->setParameters(
			[
				'links' => $this->links,
			]
		);

		$template->render();
	}

	/**
	 * @param \GrandMedia\AdminLTE\Components\Link[] $links
	 */
	public function setLinks(array $links): void
	{
		Assertion::allIsInstanceOf($links, Link::class);

		$this->links = $links;
	}

}
