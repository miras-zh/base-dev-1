<?php

namespace App\Controllers\Cli\Commands\FindPhone;

use App\Controllers\Cli\CliCommand;
use App\Controllers\Cli\CliInput;
use App\Models\company\Company;

class Find extends CliCommand
{
    public static function execute(CliInput $cliInput): int
    {
        // TODO: Implement execute() method.
        $limit = 10000;
        $offset = 0;
        $target = 'fix';
//        $target = 'phone';
//        $offset = 1000;
        $run_script = true;

        $companyModel = new Company();
        while ($run_script) {
//            echo "Limit: $limit; Offset: $offset\n";
            $companies = $companyModel->getLimitCompanies($limit, $offset);
            foreach ($companies as $company) {
                if ($target === 'phone') {
                    $address = $company['address'];
                    $phone_number = null;

                    if ($address !== null && $address !== '') {
                        if (preg_match('/тел\.\s*([0-9+\s()-]+)/u', $address, $matches)) {
                            $phoneNumber = preg_replace('/[^\d+]/', '', $matches[1]);
                        }
                    }

                    if ($phone_number !== null) {
                        if ($company['phone'] !== null && $company['phone'] !== ' ') {
                            echo 'phone: ' . $company['phone'];
                            echo '_2phone_::' . $phone_number . ' ** ' . $company['phone'];
                            echo PHP_EOL . '***' . PHP_EOL;
                            $phone_number = $phone_number . ',' . $company['phone'];
                        }

                        $status = $companyModel->updateCompany($company['id'], $company['company_name'], $company['company_bin'], $company['region'],
                            $company['address'], $company['otrasl'], $phone_number, $company['email']);

                        if ($status) {
                            echo 'UPDATE PHONE /offset' . $offset . PHP_EOL;
                        };

                        echo "Номер телефона: " . $phone_number;
                        echo PHP_EOL . '***' . PHP_EOL;
                    }
                }
                if ($target === 'fix') {
                    $input_phone_number = $company['phone'] ;
                    $formatPhoneNumber = '';
//                    разделить слитные номера через запятую
                    if ($input_phone_number !== null && preg_match_all('|\+?[87]?(7\d{9})|', $input_phone_number, $matches)) {
                        $phone_numbers = $matches[1];

                        foreach ($phone_numbers as $phone_number) {
                            $formatPhoneNumber = implode(',', $phone_numbers);
                        }
                    $status = $companyModel->updateCompany($company['id'], $company['company_name'], $company['company_bin'], $company['region'],
                        $company['address'], $company['otrasl'], $formatPhoneNumber, $company['email']);
                    }

//                    очистка символов кроме цифр
//                    $formatPhoneNumber = preg_replace('/\D/', '', $input_phone_number);
//                    $status = $companyModel->updateCompany($company['id'], $company['company_name'], $company['company_bin'], $company['region'],
//                        $company['address'], $company['otrasl'], $formatPhoneNumber, $company['email']);

                }
            }

            $offset += $limit;
            echo '>> ' . $offset . ' ' . PHP_EOL;
//            sleep(1);
            if($offset > 640000)$run_script = false;
        }
        echo 'finish';
        return 0;
    }
}