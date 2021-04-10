<?php

namespace App\Classes\Plaid\ApiClient\Api;

use GuzzleHttp\Exception\ClientException;
use App\Classes\Plaid\ApiClient\DataObjects\Person;
use App\Classes\Plaid\ApiClient\Exceptions\PeopleException;

class People extends BaseApi
{
	/**
	 * Gets a person from the mlb api.
	 * 
	 * @param string|int $extId
	 * 
	 * @throws PeopleException
	 */
	public function getPerson(string|int $extId): Person
	{
		try {
			$response = $this->client()->get("/people/{$extId}");
		} catch (ClientException $e) {
			throw new PeopleException;
		}

		$people = json_decode((string) $response->getBody(), true);

		if (empty($people)) {
			throw new PeopleException("There was no person returned from the MLB API");
		}

		$person = new Person($people[0]);

		return $person;
	}
}