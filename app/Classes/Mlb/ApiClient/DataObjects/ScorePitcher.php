<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class ScorePitcher extends BaseDataObject
{
	private int $id;
	private string $fullName;
	private string $link;

	public function __construct(array $data) {
		$this->id = $data["id"];
		$this->fullName = $data["fullName"];
		$this->link = $data["link"];
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getFullName(): string
	{
		return $this->fullName;
	}

	public function getLink(): string
	{
		return $this->link;
	}
}