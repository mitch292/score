<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class Score extends BaseDataObject
{
	private int $gamePk;
	private ScoreGameData $gameData;
	private ScoreLiveData $liveData;

	public function __construct(array $data) {
		$this->gamePk = $data["gamePk"];
		$this->gameData = new ScoreGameData($data["gameData"]);
		$this->liveData = new ScoreLiveData($data["liveData"]);
	}

	public function getGamePk(): int
	{
		return $this->gamePk;
	}

	public function getGameData(): ScoreGameData
	{
		return $this->gameData;
	}

	public function getLiveData(): ScoreLiveData
	{
		return $this->liveData;
	}
}
