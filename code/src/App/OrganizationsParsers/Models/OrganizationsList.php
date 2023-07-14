<?php

namespace App\OrganizationsParsers\Models;

class OrganizationsList
{
    /**
     * @param Organization[] $organizations
     * @param SelectionData $selection_data
     */
    public function __construct(
        public array $organizations,
        public SelectionData $selection_data,
    )
    {

    }
}