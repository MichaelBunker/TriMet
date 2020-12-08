<?php

declare(strict_types = 1);

namespace TriMet\Models;

class Arrival extends TriMetModel
{
    /**
     * @var int|null
     */
    public ?int $feet;
    /**
     * @var bool|null
     */
    public ?bool $inCongestion;
    /**
     * @var bool|null
     */
    public ?bool $departed;
    /**
     * @var int|null
     */
    public ?int $scheduled;
    /**
     * @var float|null
     */
    public ?float $loadPercentage;
    /**
     * @var string|null
     */
    public ?string $shortSign;
    /**
     * @var int|null
     */
    public ?int $estimated;
    /**
     * @var bool|null
     */
    public ?bool $detoured;
    /**
     * @var string|null
     */
    public ?string $tripID;
    /**
     * @var int|null
     */
    public ?int $dir;
    /**
     * @var int|null
     */
    public ?int $blockID;
    /**
     * @var BlockPosition
     */
    public ?object $blockPosition;
    /**
     * @var int|null
     */
    public ?int $route;
    /**
     * @var string|null
     */
    public ?string $piece;
    /**
     * @var string|null
     */
    public ?string $fullSign;
    /**
     * @var string|null
     */
    public ?string $id;
    /**
     * @var bool|null
     */
    public ?bool $dropOffOnly;
    /**
     * @var int|null
     */
    public ?int $vehicleId;
    /**
     * @var bool|null
     */
    public ?bool $showMilesAway;
    /**
     * @var int|null
     */
    public ?int $locID;
    /**
     * @var bool|null
     */
    public ?bool $newTrip;
    /**
     * @var string|null
     */
    public ?string $status;
}
