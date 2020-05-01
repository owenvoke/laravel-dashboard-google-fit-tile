<?php

namespace OwenVoke\GoogleFitTile;

use Spatie\Dashboard\Models\Tile;

class GoogleFitStore
{
    private Tile $tile;

    public static function make(): self
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName('google_fit');
    }

    public function setSleep(int $sleep): self
    {
        $this->tile->putData('sleep', $sleep);

        return $this;
    }

    public function sleep(): int
    {
        return $this->tile->getData('sleep') ?? 0;
    }

    public function setStepCount(int $steps): self
    {
        $this->tile->putData('stepCount', $steps);

        return $this;
    }

    public function stepCount(): int
    {
        return $this->tile->getData('stepCount') ?? 0;
    }
}
