<?php

declare(strict_types=1);

namespace App\OrganizationsParsers\Models;

class SelectionData
{
    public function __construct(
        public ?int $limit = null,
        public ?int $offset = null,
        public ?int $page = null,
        public ?int $total_amount = null,
        public ?int $pages_total = null,
    )
    {

    }
}