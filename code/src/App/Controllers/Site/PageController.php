<?php

declare(strict_types=1);

namespace App\Controllers\Site;

abstract class PageController
{
    abstract public static function handleRequest(SiteInput $input): ?Page;
}