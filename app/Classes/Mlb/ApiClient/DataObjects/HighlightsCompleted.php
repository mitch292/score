<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class HighlightsCompleted extends BaseDataObject
{
	/** @var HighlightItem[] */
	private array $items;

	public function __construct(array $data) {
		$this->items = !empty($data["items"]) ? array_map(fn ($item) => new HighlightItem($item), $data["items"]) : [];
	}

	/** @return HighlightItem[] */
	public function getItems(): array
	{
		return $this->items;
	}
}
