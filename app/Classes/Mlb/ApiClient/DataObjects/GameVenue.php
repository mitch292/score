<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class GameVenue extends BaseDataObject
{
	private int $id;
	private string $name;
	private string $link;

	public function __construct(array $data) {
		$this->id = $data["id"];
		$this->name = $data["name"];
		$this->link = $data["link"];
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getLink(): string
	{
		return $this->link;
	}
}