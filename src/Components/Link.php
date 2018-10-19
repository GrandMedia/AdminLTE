<?php declare(strict_types = 1);

namespace GrandMedia\AdminLTE\Components;

use Assert\Assertion;

final class Link
{

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $destination;

	private function __construct()
	{
	}

	public static function fromValues(string $title, string $destination): self
	{
		Assertion::notBlank($title);
		Assertion::notBlank($destination);

		$link = new self();
		$link->title = $title;
		$link->destination = $destination;

		return $link;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function getDestination(): string
	{
		return $this->destination;
	}

}
