<?php

namespace App\Classes\Mlb\ApiClient\DataObjects;

class HighlightItem extends BaseDataObject
{
	private string $type;
	private string $state;
	private string $date;
	private string $id;
	private string $headline;
	private string $seoTitle;
	private string $slug;
	private string $blurb;
	/** @var HighlightKeyword[] */
	private array $keywordsAll;
	/** @var HighlightKeyword[] */
	private array $keywordsDisplay;
	private HighlightImage $image;
	private bool $noIndex;
	private string $mediaPlaybackId;
	private string $title;
	private string $description;
	private string $duration;
	private string $mediaPlaybackUrl;
	/** @var HighlightPlayback[] */
	private array $playbacks;

	public function __construct(array $data) {
		$this->type = $data["type"];
		$this->state = $data["state"];
		$this->date = $data["date"];
		$this->id = $data["id"];
		$this->headline = $data["headline"];
		$this->seoTitle = $data["seoTitle"];
		$this->slug = $data["slug"];
		$this->blurb = $data["blurb"];
		$this->keywordsAll = array_map(fn ($keyword) => new HighlightKeyword($keyword), $data["keywordsAll"]);
		$this->keywordsDisplay = array_map(fn ($keyword) => new HighlightKeyword($keyword), $data["keywordsDisplay"]);
		$this->image = new HighlightImage($data["image"]);
		$this->noIndex = $data["noIndex"];
		$this->mediaPlaybackId = $data["mediaPlaybackId"];
		$this->title = $data["title"];
		$this->description = $data["description"];
		$this->duration = $data["duration"];
		$this->mediaPlaybackUrl = $data["mediaPlaybackUrl"];
		$this->playbacks = array_map(fn ($playback) => new HighlightPlayback($playback), $data["playbacks"]);
	}

	public function getType(): string
	{
		return $this->type;
	}

	public function getState(): string
	{
		return $this->state;
	}

	public function getDate(): string
	{
		return $this->date;
	}
	
	public function getId(): string
	{
		return $this->id;
	}

	public function getHeadline(): string
	{
		return $this->headline;
	}

	public function getSeoTitle(): string
	{
		return $this->seoTitle;
	}

	public function getSlug(): string
	{
		return $this->slug;
	}

	public function getBlurb(): string
	{
		return $this->blurb;
	}

	/** @return HighlightKeyword[] */
	public function getKeywordsAll(): array
	{
		return $this->keywordsAll;
	}

	/** @return HighlightKeyword[] */
	public function getKeywordsDisplay(): array
	{
		return $this->keywordsDisplay;
	}

	public function getImage(): HighlightImage
	{
		return $this->image;
	}

	public function getNoIndex(): bool
	{
		return $this->noIndex;
	}

	public function getMediaPlaybackId(): string
	{
		return $this->mediaPlaybackId;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function getDuration(): string
	{
		return $this->duration;
	}

	public function getMediaPlaybackUrl(): string
	{
		return $this->mediaPlaybackUrl;
	}

	/** @return HighlightPlayback[] */
	public function getPlaybacks(): array
	{
		return $this->playbacks;
	}

	public function getFirstPlayback(): ?HighlightPlayback
	{
		if (empty($this->playbacks)) {
			return null;
		}

		return $this->playbacks[0];
	}
}