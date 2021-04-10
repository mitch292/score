<?php

namespace App\Classes\Mlb\ApiClient\Api;

use GuzzleHttp\Exception\ClientException;
use App\Classes\Plaid\ApiClient\DataObjects\Schedule;
use App\Classes\Plaid\ApiClient\Exceptions\ScheduleException;

class People extends BaseApi
{
	/**
	 * Gets a schedule for a given date
	 * 
	 * @param string $date in YYYY-MM-DD
	 * @return Scedule
	 * @throws ScheduleException
	 */
	public function getSchedule(string $date): Scedule
	{
		try {
			$response = $this->client()->get("/people/{$extId}");
		} catch (ClientException $e) {
			throw new ScheduleException($e->getMessage());
		}

		$rawSchedule = json_decode((string) $response->getBody(), true);

		if (empty($rawSchedule)) {
			throw new ScheduleException("There was no schedule for the given day");
		}

		$schedule = new Scedule($rawSchedule);

		return $schedule;
	}
}