<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class HandPreference extends BaseDataObject
{
	private string $code;
	private string $description;

	public function __construct(array $data) {
		$this->code = $data["code"];
		$this->name = $data["description"];
	}

	public function getCode(): string
	{
		return $this->code;
	}

	public function getDescription(): string
	{
		return $this->description;
	}
}