<?php

declare(strict_types = 1);

namespace TriMet\Models;

class Trip extends TriMetModel
{
    /**
     * @var int|null
     */
    public ?int $route;
    /**
     * @var int|null
     */
    public ?int $destDist;
    /**
     * @var int|null
     */
    public ?int $pattern;
    /**
     * @var int|null
     */
    public ?int $progress;
    /**
     * @var string|null
     */
    public ?string $id;
    /**
     * @var int|null
     */
    public ?int $dir;
    /**
     * @var bool|null
     */
    public ?bool $newTrip;
    /**
     * @var string|null
     */
    public ?string $desc;
}
