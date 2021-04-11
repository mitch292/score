<?php

namespace App\Classes\Mlb\ApiClient\Api;

use GuzzleHttp\Exception\ClientException;
use App\Classes\Mlb\ApiClient\DataObjects\Person;
use App\Classes\Plaid\ApiClient\Exceptions\PeopleException;

class People extends BaseApi
{
	/**
	 * Gets a person from the mlb api.
	 * 
	 * @param string|int $extId
	 * @return Person
	 * @throws PeopleException
	 */
	public function getPerson(string|int $extId): Person
	{
		try {
			$response = $this->client()->get("people/{$extId}");
		} catch (ClientException $e) {
			throw new PeopleException;
		}

		$data = json_decode((string) $response->getBody(), true);

		if (empty($data) || count($data["people"]) < 1) {
			throw new PeopleException("There was no person returned from the MLB API");
		}

		$person = new Person($data["people"][0]);

		return $person;
	}
}