<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\Components;

final class Link
{

	/** @var string */
	private $title;

	/** @var string */
	private $link;

	/** @var string|null */
	private $icon;

	public function __construct(string $title, string $link, ?string $icon = null)
	{
		$this->title = $title;
		$this->link = $link;
		$this->icon = $icon;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function getLink(): string
	{
		return $this->link;
	}

	public function getIcon(): ?string
	{
		return $this->icon;
	}

}
