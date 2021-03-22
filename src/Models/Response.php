<?php

declare(strict_types = 1);

namespace TriMet\Models;

class Response extends TriMetModel
{
    /**
     * @var mixed
     */
    public mixed $queryTime = null;
    /**
     * @var Location[]
     */
    public ?array $location = null;
    /**
     * @var Route[]
     */
    public ?array $route = null;
    /**
     * @var Alert[]
     */
    public ?array $alert = null;
    /**
     * @var Arrival[]
     */
    public ?array $arrival = null;
    /**
     * @var Detour[]
     */
    public ?array $detour = null;
}
