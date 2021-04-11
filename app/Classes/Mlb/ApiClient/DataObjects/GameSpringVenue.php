<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class GameSpringVenue extends BaseDataObject
{
	private int $id;
	private string $link;

	public function __construct(array $data) {
		$this->id = $data["id"];
		$this->link = $data["link"];
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getLink(): string
	{
		return $this->link;
	}
}