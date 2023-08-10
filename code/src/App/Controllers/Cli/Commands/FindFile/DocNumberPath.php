<?php

namespace App\Controllers\Cli\Commands\FindFile;

use App\Controllers\Cli\CliCommand;
use App\Controllers\Cli\CliInput;
use App\Models\company\Company;
use App\Models\Treaty\Treaty;

class DocNumberPath extends CliCommand
{
    public static function execute(CliInput $cliInput): int
    {
//        var_dump('-->pwd>', ROOT_DIR . '/doc');
        $listDir = scandir(ROOT_DIR . '/doc');
        $filteredListDir = array_map(function ($item) {
            return preg_replace('/[^0-9]/', '', $item);
        }, $listDir);
//        var_dump('-->',$listDir);
        $limit = 10;
        $offset = 0;
        $run_script = true;
        $treatyModel = new Treaty();
        while ($run_script) {
            $treaties = $treatyModel->getLimitTreaties($limit, $offset);
            foreach ($treaties as $treaty) {
//                echo 'treatu bumber>' . $treaty['number'] . PHP_EOL;
                $numb = preg_replace('/[^0-9]/', '', $treaty['number']);
//                echo 'trim num:' . $numb . PHP_EOL;

//                $hasItem = in_array($numb, $filteredListDir);
                $hasIndex = array_search($numb, $filteredListDir);
                if($hasIndex) {
                    echo '**** hasItem: '. $listDir[$hasIndex]. PHP_EOL;
                 $status = $treatyModel->updateTreaty($treaty['id'], $treaty['number'], $treaty['iniciator'], $treaty['contractor'],
                     $treaty['subject'], $treaty['sum'], $treaty['sum_service'], $listDir[$hasIndex], '' ,  $listDir[$hasIndex]);
                 if($status)echo 'update file path'. PHP_EOL;
                };
            }

            $offset += $limit;
            echo '>> ' . $offset . ' ' . PHP_EOL;
            if ($offset > 1300) $run_script = false;
        }
        echo 'finish';
        return 0;
    }
}
