<?php

namespace App\Classes\Mlb\ApiClient\Api;

use GuzzleHttp\Exception\ClientException;
use App\Classes\Mlb\ApiClient\Exceptions\ScoreException;
use App\Classes\Mlb\ApiClient\DataObjects\Score as ScoreDataObject;

class Score extends BaseApi
{
	/**
	 * Gets a score for a given external id
	 * 
	 * @param string|int $extId
	 * @return ScoreDataObject
	 * @throws ScoreException
	 */
	public function getScore(string|int $extId): ScoreDataObject
	{
		try {
			$response = $this->client()->get("game/{$extId}/feed/live");
		} catch (ClientException $e) {
			throw new ScoreException($e->getMessage());
		}

		$rawScore = json_decode((string) $response->getBody(), true);

		if (empty($rawScore)) {
			throw new ScoreException("There was no score data available.");
		}

		$score = new ScoreDataObject($rawScore);

		return $score;
	}
}