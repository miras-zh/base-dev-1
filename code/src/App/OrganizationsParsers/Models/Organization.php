<?php

namespace App\OrganizationsParsers\Models;

use Kuvardin\KzIdentifiers\Biin;

class Organization
{
    public Biin $biin;

    public function __construct(Biin $biin)
    {
        $this->biin = $biin;
    }


}