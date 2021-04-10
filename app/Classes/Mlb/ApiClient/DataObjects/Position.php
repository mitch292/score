<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class Position extends BaseDataObject
{
	private string $code;
	private string $name;
	private string $type;
	private string $abbreviation;

	public function __construct(array $data) {
		$this->code = $data["code"];
		$this->name = $data["name"];
		$this->type = $data["type"];
		$this->abbreviation = $data["abbreviation"];
	}

	public function getCode(): string
	{
		return $this->code;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getType(): string
	{
		return $this->type;
	}
	
	public function getAbbreviation(): string
	{
		return $this->abbreviation;
	}
}