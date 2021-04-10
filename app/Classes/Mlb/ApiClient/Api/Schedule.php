<?php

namespace App\Classes\Mlb\ApiClient\Api;

use GuzzleHttp\Exception\ClientException;
use App\Classes\Mlb\ApiClient\DataObjects\Schedule as ScheduleDataObject;
use App\Classes\Mlb\ApiClient\Exceptions\ScheduleException;

class Schedule extends BaseApi
{
	/**
	 * Gets a schedule for a given date
	 * 
	 * @param string $date in YYYY-MM-DD
	 * @return Schedule
	 * @throws ScheduleException
	 */
	public function getSchedule(string $date): ScheduleDataObject
	{
		try {
			$response = $this->client()->get("schedule", [
				'query' => [
					'sportId' => 1,
					'date' => $date,
				],
			]);
		} catch (ClientException $e) {
			throw new ScheduleException($e->getMessage());
		}

		$rawSchedule = json_decode((string) $response->getBody(), true);

		if (empty($rawSchedule)) {
			throw new ScheduleException("There was no schedule for the given day");
		}

		$schedule = new ScheduleDataObject($rawSchedule);

		return $schedule;
	}
}