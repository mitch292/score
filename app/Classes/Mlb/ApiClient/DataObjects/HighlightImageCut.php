<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class HighlightImageCut extends BaseDataObject
{
	private string $aspectRatio;
	private int $width;
	private int $height;
	private string $src;
	private string $at2x;
	private string $at3x;

	public function __construct(array $data) {
		$this->aspectRatio = $data["aspectRatio"];
		$this->width = $data["width"];
		$this->height = $data["height"];
		$this->src = $data["src"];
		$this->at2x = $data["at2x"];
		$this->at3x = $data["at3x"];
	}

	public function getAspectRatio(): string
	{
		return $this->aspectRatio;
	}

	public function getWidth(): int
	{
		return $this->width;
	}

	public function getHeight(): int
	{
		return $this->height;
	}

	public function getSrc(): string
	{
		return $this->src;
	}

	public function getAt2x(): string
	{
		return $this->at2x;
	}

	public function getAt3x(): string
	{
		return $this->at3x;
	}
}