<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class LinescoreSummary extends BaseDataObject
{
	private int $runs;
	private int $hits;
	private int $errors;
	private int $leftOnBase;

	public function __construct(array $data) {
		$this->runs = $data["runs"] ?? 0;
		$this->hits = $data["hits"] ?? 0;
		$this->errors = $data["errors"] ?? 0;
		$this->leftOnBase = $data["leftOnBase"] ?? 0;
	}

	public function getRuns(): int
	{
		return $this->runs;
	}

	public function getHits(): int
	{
		return $this->hits;
	}

	public function getErrors(): int
	{
		return $this->errors;
	}

	public function getLeftOnBase(): int
	{
		return $this->leftOnBase;
	}
}