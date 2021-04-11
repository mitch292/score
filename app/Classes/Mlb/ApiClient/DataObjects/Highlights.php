<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class Highlights extends BaseDataObject
{
	private HighlightsCompleted $highlights;
	private HighlightsLive $live;

	public function __construct(array $data) {
		$this->highlights = new HighlightsCompleted($data["highlights"]);
		$this->live = new HighlightsLive($data["live"]);
	}

	public function getHighlights(): HighlightsCompleted
	{
		return $this->highlights;
	}

	public function getLive(): HighlightsLive
	{
		return $this->live;
	}
}
