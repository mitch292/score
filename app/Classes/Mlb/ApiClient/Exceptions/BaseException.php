<?php

namespace App\Classes\Mlb\ApiClient\Exceptions;

use Exception;

class PlaidException extends Exception
{
	public function __construct(string $message, int $code = 400)
	{
		parent::__construct($message, $code);
	}
}