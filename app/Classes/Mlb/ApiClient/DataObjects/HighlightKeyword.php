<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class HighlightKeyword extends BaseDataObject
{
	private string $type;
	private string $value;
	private string $displayName;

	public function __construct(array $data) {
		$this->type = $data["type"];
		$this->value = $data["value"];
		$this->displayName = $data["displayName"];
	}

	public function gettype(): string
	{
		return $this->type;
	}

	public function getValue(): string
	{
		return $this->value;
	}

	public function getDisplayName(): string
	{
		return $this->displayName;
	}
}