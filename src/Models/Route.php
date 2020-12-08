<?php

declare(strict_types = 1);

namespace TriMet\Models;

class Route extends TriMetModel
{
    /**
     * @var string|null
     */
    public ?string $routeColor;
    /**
     * @var string|null
     */
    public ?string $frequentService;
    /**
     * @var int|null
     */
    public ?int $route;
    /**
     * @var int|null
     */
    public ?int $id;
    /**
     * @var string|null
     */
    public ?string $type;
    /**
     * @var string|null
     */
    public ?string $desc;
    /**
     * @var int|null
     */
    public ?int $routeSortOrder;
}
