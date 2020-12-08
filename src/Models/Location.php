<?php

declare(strict_types = 1);

namespace TriMet\Models;

class Location extends TriMetModel
{
    /**
     * @var float|null
     */
    public ?float $lng;
    /**
     * @var bool|null
     */
    public ?bool $no_service_flag;
    /**
     * @var string|null
     */
    public ?string $passengerCode;
    /**
     * @var int|null
     */
    public ?int $id;
    /**
     * @var string|null
     */
    public ?string $dir;
    /**
     * @var float|null
     */
    public ?float $lat;
    /**
     * @var string|null
     */
    public ?string $desc;
}
