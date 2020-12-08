<?php

declare(strict_types = 1);

namespace TriMet\Models;

class Alert extends TriMetModel
{
    /**
     * @var Route[]
     */
    public ?array $route;
    /**
     * @var string|null
     */
    public ?string $info_link_url;
    /**
     * @var string|null
     */
    public ?string $end;
    /**
     * @var bool|null
     */
    public ?bool $system_wide_flag;
    /**
     * @var int|null
     */
    public ?int $id;
    /**
     * @var string|null
     */
    public ?string $header_text;
    /**
     * @var int|null
     */
    public ?int $begin;
    /**
     * @var string|null
     */
    public ?string $desc;
    /**
     * @var Location[]
     */
    public ?array $location;
}
