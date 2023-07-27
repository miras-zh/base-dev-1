<?php

declare(strict_types=1);

namespace App\OrganizationsParsers\Parsers;

use App\Models\company\Company;
use App\OrganizationsParsers\Models\OrganizationsList;
use App\OrganizationsParsers\Models\SelectionData;
use App\OrganizationsParsers\ParserAbstract;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Miko\EgovData\Api;

class FindPhone extends ParserAbstract
{
    public static function getCode(): string
    {
        return 'FIND_PHONE';
    }

    public function getOrganizationsList(SelectionData $selection_data = null): OrganizationsList
    {
        return [];
    }

    public function updatePhoneOrganizations(){
        $limit = 100;
        $offset = 0;

        $companyModel = new Company();
        while (true) {
            echo "Limit: $limit; Offset: $offset\n";
            $companies = $companyModel->getLimitCompanies($limit, $offset);
            var_dump($companies);
            exit();
            $offset += $limit;
            sleep(2);
        }
    }
}