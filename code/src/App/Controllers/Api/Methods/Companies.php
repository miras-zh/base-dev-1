<?php

namespace App\Controllers\Api\Methods;

use App\Controllers\Api\ApiMethod;
use App\Models\company\Company;

class Companies extends ApiMethod
{
    public static function execute(array $params = []): ?array
    {
        var_dump($params);
        $companyModel = new Company();
        return $companyModel->getAllCompanies($params['page'] || 1, $params['count']);
    }
}