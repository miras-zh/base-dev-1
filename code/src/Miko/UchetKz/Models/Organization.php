<?php

declare(strict_types=1);

namespace Miko\UchetKz\Models;

use Kuvardin\KzIdentifiers\Biin;

class Organization
{
    public function __construct(
        public Biin $biin,
        public string $name,
        public ?string $rnn = null,
    )
    {

    }
}