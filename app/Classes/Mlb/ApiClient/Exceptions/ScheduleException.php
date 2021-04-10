<?php

namespace App\Classes\Mlb\ApiClient\Exceptions;

class ScheduleException extends BaseException
{
	public function __construct(string $message = "The schedule could not be retrieved from the MLB.", int $code = 400)
	{
		parent::__construct($message, $code);
	}
}