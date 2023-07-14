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

class EgovData extends ParserAbstract
{
    public static function getCode(): string
    {
        return 'EGOV_DATA';
    }

   public function getOrganizationsList(SelectionData $selection_data = null): OrganizationsList
   {
       $limit = 100;
       $offset = 815800;

       $token = '504491c058d3439a8ebc7f666cd83b5d';
       $api = new Api($this->client, $token);


       $companyModel = new Company();
       $beforeCompanies = $companyModel->getCompaniesNumber();

       while (true) {
           echo "Limit: $limit; Offset: $offset\n";

           try {
               $response = $api->getData('v4/gbd_ul/v1', $limit, $offset);
               $received_number = count($response);
               echo "\tReceived: $received_number\n";
           } catch (GuzzleException $exception) {
               echo $exception, PHP_EOL;
               continue;
           }


           foreach ($response as $organization_data) {
//                print_r($organization_data);
//                echo "\n";
//                echo $organization_data['id'] ."\n";
               $companyModel = new Company();
               $companyFound = $companyModel->checkCompanyByBin($organization_data['bin']);
               if (!$companyFound) {
                   echo '+ + add:' . $organization_data['bin'] . " /" . $organization_data['nameru'] . "\n";
                   $companyModel->createCompany($organization_data['nameru'], $organization_data['bin'], 'Kazakhstan', $organization_data['addressru'], $organization_data['okedru'], '', '', $organization_data['director']);
               } else {
                   echo '- - no:' . $organization_data['bin'] . " /" . $organization_data['nameru'] . "\n";
               }
           }
           $companyModel = new Company();
           $countComp = $companyModel->getCompaniesNumber();
           echo "-------- $offset: " . $offset . " (+" . $countComp - $beforeCompanies . ")" ."/// ".$beforeCompanies. "\n";

           $offset += $limit;
           sleep(5);
       }
   }
}