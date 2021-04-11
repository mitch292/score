<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class HighlightImage extends BaseDataObject
{
	private string $title;
	private ?string $altText;
	private string $templateUrl;
	/** @var HighlightImageCut[] */
	private array $cuts;

	public function __construct(array $data) {
		$this->title = $data["title"];
		$this->altText = $data["altText"] ?? null;
		$this->templateUrl = $data["templateUrl"];
		$this->cuts = array_map(fn ($cut) => new HighlightImageCut($cut), $data["cuts"]);
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function getAltText(): ?string
	{
		return $this->altText;
	}

	public function getTemplateUrl(): string
	{
		return $this->templateUrl;
	}

	/** @return HighlightImageCut[] */
	public function getCuts(): array
	{
		return $this->cuts;
	}
}