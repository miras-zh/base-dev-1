<?php

declare(strict_types=1);

namespace Miko\UchetKz\Models;

class OrganizationsList
{
    /**
     * @param Organization[] $organizations
     * @param int $pages_total
     */
    public function __construct(
        public int $pages_total,
        public array $organizations = [],
    )
    {

    }
}