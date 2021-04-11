<?php

namespace App\Classes\Mlb\ApiClient\Api;

use GuzzleHttp\Exception\ClientException;
use App\Classes\Plaid\ApiClient\Exceptions\HighlightsException;
use App\Classes\Mlb\ApiClient\DataObjects\Highlights as HighlightsDataObject;

class Highlights extends BaseApi
{
	/**
	 * Gets highlights from the mlb api.
	 * 
	 * @param string|int $extId
	 * @return HighlightsDataObject
	 * @throws HighlightsException
	 */
	public function getHighlights(string|int $extId): HighlightsDataObject
	{
		try {
			$response = $this->client()->get("game/{$extId}/content");
		} catch (ClientException $e) {
			throw new HighlightsException;
		}

		$data = json_decode((string) $response->getBody(), true);

		if (empty($data["highlights"])) {
			throw new HighlightsException("There were no highlights returned from the MLB API");
		}

		$highlights = new HighlightsDataObject($data["highlights"]);

		return $highlights;
	}
}