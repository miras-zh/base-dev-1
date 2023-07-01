<?php

declare(strict_types=1);

namespace App\Controllers\Cli;

class CliInput
{
    protected array $argv;

    public function __construct(array $argv)
    {
        $this->argv = $argv;
    }

    public function getParameter(int $index): ?string
    {
        return $this->argv[$index - 2] ?? null;
    }
}