<?php

declare(strict_types=1);

namespace App\Controllers\Cli;

abstract class CliCommand
{
    abstract public static function execute(CliInput $cliInput): int;
}