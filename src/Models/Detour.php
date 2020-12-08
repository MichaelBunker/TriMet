<?php

declare(strict_types = 1);

namespace TriMet\Models;

class Detour extends TriMetModel
{
    /**
     * @var string|null
     */
    public ?string $info_link_url;
    /**
     * @var int|null
     */
    public ?int $end;
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
}
