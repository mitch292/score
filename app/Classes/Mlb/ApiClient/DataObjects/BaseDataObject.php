<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

use ReflectionClass;

abstract class BaseDataObject
{
	public function all(): array
	{
		$data = [];

		$class = new ReflectionClass(static::class);

		$properties = $class->getProperties();

		foreach ($properties as $reflectionProperty) {
			// Skip static properties
			if ($reflectionProperty->isStatic()) {
				continue;
			}

			// Allow this function to temporarily access private properties
			$reflectionProperty->setAccessible(true);
			$data[$reflectionProperty->getName()] = $reflectionProperty->getValue($this);
			$reflectionProperty->setAccessible(false);
		}


		return $data;
	}

	public function toArray(): array
	{
		return $this->parseArray($this->all());
	}

	private function parseArray(array $array): array
	{
		foreach ($array as $key => $value) {
			if ($value instanceof BaseDataObject) {
				$array[$key] = $value->toArray();

				continue;
			}

			if (!is_array($value)) {
				continue;
			}

			$array[$key] = $this->parseArray($value);
		}

		return $array;
	}
}
