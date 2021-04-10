<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class GameContent extends BaseDataObject
{
	private string $link;

	public function __construct(array $data) {
		$this->link = $data["link"];
	}

	public function getLink(): string
	{
		return $this->link;
	}
}