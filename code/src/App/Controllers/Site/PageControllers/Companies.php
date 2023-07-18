<?php

declare(strict_types=1);

namespace App\Controllers\Site\PageControllers;

use App\Controllers\Site\Page;
use App\Controllers\Site\PageController;
use App\Controllers\Site\SiteInput;
use App\Utils\TemplatesEngine;

class Companies extends PageController
{
    public static function handleRequest(SiteInput $input): ?Page
    {
        $page = new Page('Organizations');

        $companies = [];
        $page->content .= TemplatesEngine::render('companies/companies_list', [
            'companies' => $companies,
        ]);

        return $page;
    }
}