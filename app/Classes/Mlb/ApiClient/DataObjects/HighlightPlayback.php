<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class HighlightPlayback extends BaseDataObject
{
	private string $name;
	private string $url;
	private string $width;
	private string $height;

	public function __construct(array $data) {
		$this->name = $data["name"];
		$this->url = $data["url"];
		$this->width = $data["width"];
		$this->height = $data["height"];
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getUrl(): string
	{
		return $this->url;
	}

	public function getWidth(): string
	{
		return $this->width;
	}

	public function getHeight(): string
	{
		return $this->height;
	}
}