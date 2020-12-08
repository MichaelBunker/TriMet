<?php

declare(strict_types = 1);

namespace TriMet\Models;

class BlockPosition extends TriMetModel
{
    /**
     * @var int|null
     */
    public ?int $routeNumber;
    /**
     * @var string|null
     */
    public ?string $signMessage;
    /**
     * @var float|null
     */
    public ?float $lng;
    /**
     * @var int|null
     */
    public ?int $scheduled;
    /**
     * @var int|null
     */
    public ?int $heading;
    /**
     * @var int|null
     */
    public ?int $nextStopSeq;
    /**
     * @var string|null
     */
    public ?string $tripID;
    /**
     * @var int|null
     */
    public ?int $at;
    /**
     * @var Trip[]
     */
    public ?array $trip;
}
