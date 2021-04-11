<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class Person extends BaseDataObject
{
	private int $externalId;
	private string $fullName;
	private string $link;
	private string $firstName;
	private string $lastName;
	private string $primaryNumber;
	private string $birthDate;
	private int $currentAge;
	private string $birthCity;
	private string $birthStateProvince;
	private string $birthCountry;
	private string $height;
	private bool $active;
	private Position $position;
	private string $useName;
	private string $boxscoreName;
	private ?string $nickName;
	private string $gender;
	private ?string $nameMatrilineal;
	private bool $isPlayer;
	private bool $isVerified;
	private ?string $pronunciation;
	private ?string $mlbDebutDate;
	private HandPreference $batSide;
	private HandPreference $pitchHand;
	private string $nameFirstLast;
	private string $nameSlug;
	private string $firstLastName;
	private string $lastFirstName;
	private string $lastInitName ;
	private string $initLastName;
	private string $fullFMLName;
	private string $fullLFMName;
	private float $strikeZoneTop;
	private float $strikeZoneBottom;


	public function __construct(array $data) {
		$this->externalId = $data["id"];
		$this->fullName = $data["fullName"];
		$this->link = $data["link"];
		$this->firstName = $data["firstName"];
		$this->lastName = $data["lastName"];
		$this->primaryNumber = $data["primaryNumber"];
		$this->birthDate = $data["birthDate"];
		$this->currentAge = $data["currentAge"];
		$this->birthCity = $data["birthCity"];
		$this->birthStateProvince = $data["birthStateProvince"];
		$this->birthCountry = $data["birthCountry"];
		$this->height = $data["height"];
		$this->weight = $data["weight"];
		$this->active = $data["active"];
		$this->primaryPosition = new Position($data["primaryPosition"]);
		$this->useName = $data["useName"];
		$this->boxscoreName = $data["boxscoreName"];
		$this->nickName = $data["nickName"] ?? null;
		$this->gender = $data["gender"];
		$this->nameMatrilineal = $data["nameMatrilineal"] ?? null;
		$this->isPlayer = $data["isPlayer"];
		$this->isVerified = $data["isVerified"];
		$this->pronunciation = $data["pronunciation"] ?? null;
		$this->mlbDebutDate = $data["mlbDebutDate"] ?? null;
		$this->batSide = new HandPreference($data["batSide"]);
		$this->pitchHand = new HandPreference($data["pitchHand"]);
		$this->nameFirstLast = $data["nameFirstLast"];
		$this->nameSlug = $data["nameSlug"];
		$this->firstLastName = $data["firstLastName"];
		$this->lastFirstName = $data["lastFirstName"];
		$this->lastInitName = $data["lastInitName"];
		$this->initLastName = $data["initLastName"];
		$this->fullFMLName = $data["fullFMLName"];
		$this->fullLFMName = $data["fullLFMName"];
		$this->strikeZoneTop = $data["strikeZoneTop"];
		$this->strikeZoneBottom = $data["strikeZoneBottom"];
	}

	public function getExternalId(): string
	{
		return $this->externalId;
	}

	public function getFullName(): string
	{
		return $this->fullName;
	}

	public function getLink(): string
	{
		return $this->link;
	}

	public function getFirstName(): string
	{
		return $this->firstName;
	}

	public function getLastName(): string
	{
		return $this->lastName;
	}

	public function getPrimaryNumber(): string
	{
		return $this->primaryNumber;
	}

	public function getBirthDate(): string
	{
		return $this->birthDate;
	}

	public function getCurrentAge(): string
	{
		return $this->currentAge;
	}

	public function getBirthCity(): string
	{
		return $this->birthCity;
	}

	public function getBirthStateProvince(): string
	{
		return $this->birthStateProvince;
	}

	public function getBirthCountry(): string
	{
		return $this->birthCountry;
	}

	public function getHeight(): string
	{
		return $this->height;
	}

	public function getActive(): bool
	{
		return $this->active;
	}

	public function getPosition(): Position
	{
		return $this->position;
	}

	public function getUseName(): string
	{
		return $this->useName;
	}

	public function getBoxscoreName(): string
	{
		return $this->boxscoreName;
	}

	public function getNickName(): ?string
	{
		return $this->nickName;
	}

	public function getGender(): string
	{
		return $this->gender;
	}

	public function getNameMatrilineal(): ?string
	{
		return $this->nameMatrilineal;
	}

	public function getIsPlayer(): bool
	{
		return $this->isPlayer;
	}

	public function getIsVerified(): bool
	{
		return $this->isVerified;
	}

	public function getPronunciation(): ?string
	{
		return $this->pronunciation;
	}

	public function getMlbDebutDate(): ?string
	{
		return $this->mlbDebutDate;
	}

	public function getBatSide(): HandPreference
	{
		return $this->batSide;
	}

	public function getPitchHand(): HandPreference
	{
		return $this->pitchHand;
	}

	public function getNameFirstLast(): string
	{
		return $this->nameFirstLast;
	}
	
	public function getNameSlug(): string
	{
		return $this->nameSlug;
	}
	
	public function getFirstLastName(): string
	{
		return $this->firstLastName;
	}
	
	public function getLastFirstName(): string
	{
		return $this->lastFirstName;
	}
	
	public function getLastInitName(): string
	{
		return $this->lastInitName;
	}
	
	public function getInitLastName(): string
	{
		return $this->initLastName;
	}

	public function getFullFMLName(): string
	{
		return $this->fullFMLName;
	}
	
	public function getFullLFMName(): string
	{
		return $this->fullLFMName;
	}
	
	public function getStrikeZoneTop(): float
	{
		return $this->strikeZoneTop;
	}

	public function getStrikeZoneBottom(): float
	{
		return $this->strikeZoneBottom;
	}
}