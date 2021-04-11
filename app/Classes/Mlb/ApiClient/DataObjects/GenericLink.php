<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class GenericLink extends BaseDataObject
{
	private int $id;
	private string $name;
	private string $link;
	private ?string $abbreviation;

	public function __construct(array $data) {
		$this->id = $data["id"];
		$this->name = $data["name"];
		$this->link = $data["link"];
		$this->abbreviation = $data["abbreviation"] ?? null;
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

	public function getAbbreviation(): ?string
	{
		return $this->abbreviation;
	}
}