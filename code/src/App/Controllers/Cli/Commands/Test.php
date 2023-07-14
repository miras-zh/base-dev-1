<?php

declare(strict_types=1);

namespace App\Controllers\Cli\Commands;

use App\Controllers\Cli\CliCommand;
use App\Controllers\Cli\CliInput;
use App\Models\company\Company;

class Test extends CliCommand
{
    public static function execute(CliInput $cliInput): int
    {
        $limit = 10000;
        $offset = 250000;

        $biins = [];

        $deleted = 0;
        $total = 0;

        while (true) {
            $deletedCurrent = 0;

            $companyModel = new Company();

            /** @var \PDOStatement|bool $result */
            $result = $companyModel->runQuery("SELECT `id`, `company_bin` FROM `companies` LIMIT $limit OFFSET $offset");
            if ($result === false) {
                exit('PDO query failed');
            }

            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $total++;

                if (empty($row['company_bin'])) {
                    continue;
                }

                if (in_array($row['company_bin'], $biins, true)) {
                    $companyModel->runQuery("DELETE FROM `companies` WHERE `id` = {$row['id']} LIMIT 1");
                    $deleted++;
                    $deletedCurrent++;
                } else {
                    $biins[] = $row['company_bin'];
                }
            }

            echo "Limit: $limit; Offset: $offset; Deleted: $deleted; Total: $total\n";
            $offset += $limit - $deletedCurrent;
        }

        return 0;
    }
}