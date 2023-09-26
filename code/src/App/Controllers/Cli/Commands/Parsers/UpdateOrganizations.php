<?php

declare(strict_types=1);

namespace App\Controllers\Cli\Commands\Parsers;

use App\Controllers\Cli\CliCommand;
use App\Controllers\Cli\CliInput;
use App\OrganizationsParsers\Parsers\EgovData;
use App\OrganizationsParsers\Parsers\FindPhone;
use App\OrganizationsParsers\ParsersController;
use GuzzleHttp\Client;

class UpdateOrganizations extends CliCommand
{
    public static function execute(CliInput $cliInput): int
    {
        $parser_code = $cliInput->getParameter(0);
        if ($parser_code === null) {
            exit("Empty parser code\n");
        }

        $token = null;
        if ($parser_code === EgovData::getCode()) {
            $token = '504491c058d3439a8ebc7f666cd83b5d';
        }

        $parser = ParsersController::getParser($parser_code, new Client(), $token);

        if($parser_code === FindPhone::getCode()){
            $parser->updatePhoneOrganizations();
        }else{
            $organizations_list = $parser->getOrganizationsList();
        }

        print_r($organizations_list);

        return 0;
    }
}