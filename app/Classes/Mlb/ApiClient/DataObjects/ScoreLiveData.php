<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class ScoreLiveData extends BaseDataObject
{
	private ScoreLinescore $linescore;

	public function __construct(array $data) {
		$this->linescore = new ScoreLinescore($data["linescore"]);
	}

	public function getLinescore(): ScoreLinescore
	{
		return $this->linescore;
	}
}