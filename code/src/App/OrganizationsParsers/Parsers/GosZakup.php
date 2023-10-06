<?php

declare(strict_types=1);

namespace App\OrganizationsParsers\Parsers;

use App\Models\company\Company;
use App\OrganizationsParsers\Models\OrganizationsList;
use App\OrganizationsParsers\Models\SelectionData;
use App\OrganizationsParsers\ParserAbstract;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Miko\EgovData\Api;

class GosZakup extends ParserAbstract
{

    protected const HOST = 'https://www.goszakup.gov.kz';

    public static function getCode(): string
    {
        return 'GOSZAKUP';
    }

    public function getOrganizationsList(SelectionData $selection_data = null): OrganizationsList
    {
        $limit = 100;
        $offset = 66037;
        $countUpdated = 0;
        $countAdd = 0;
        $countNoFitler = 0;
        do {


//            $page = $this->request('ru/registry/supplierreg', ['count_record' => $selection_data?->limit ?? 50,'page' => $num]);
            $companyModel = new Company();
            $links = $companyModel->getLink($limit, $offset);
//              var_dump($links);
//              exit();
//              exit($links);

            foreach ($links as $key => $value) {
                echo $offset + $key . ') ';

                while (true) {
                    try {
                        $page = $this->request($value['link']);
                        break;
                    } catch (GuzzleException $exception) {
                        echo "cURL error #{$exception->getCode()}: {$exception->getMessage()}\n";
                        sleep(5);
                    }
                }


                if (preg_match_all('/<tr>\s*<th>(.*?)<\/th>\s*<td>(.*?)<\/td>\s*<\/tr>/s', $page, $matches2)) {
                    $data = array_combine($matches2[1], $matches2[2]);
                    // Создаем ассоциативный массив для переименованных ключей
                    $renamedData = array(
                        "date_last_updated" => trim($data["Дата последнего обновления"] ?? ''),
                        "roles" => trim($data["Роли участника"] ?? ''),
                        "exists_in_reestr" => trim($data["Состоит в реестре государственных заказчиков"] ?? ''),
                        "bin" => trim($data["БИН участника"] ?? ''),
                        "iin" => trim($data["ИИН участника"] ?? ''),
                        "rnn" => trim($data["РНН участника"] ?? ''),
                        "namekz" => trim($data["Наименование на каз. языке"] ?? ''),
                        "nameru" => trim($data["Наименование на рус. языке"] ?? ''),
                        "resident" => trim($data["Резиденство"] ?? ''),
                        "kato" => trim($data["КАТО"] ?? ''),
                        "region" => trim($data["Регион"] ?? ''),
                        "website" => trim($data["Вебсайт:"] ?? ''),
                        "email" => trim($data["E-Mail:"] ?? ''),
                        "phone" => trim($data["Контактный телефон:"] ?? ''),
                        "number_id" => trim($data["Серия свидетельства (для ИП) и номер свидетельства о государственной регистрации"] ?? ''),
                        "date_registration" => trim($data["Дата свидетельства о государственной регистрации"] ?? ''),
                        "admin_reporting" => trim($data["Наименование администратора(ов) отчетности"] ?? ''),
                    );
                    $biin = empty($renamedData['bin'])? $renamedData['iin'] : $renamedData['bin'];

                    $companyFound = $companyModel->checkCompanyByBin($biin);
                    if (!$companyFound) {
                        $isAdd = $companyModel->createCompanyGos(
                            $renamedData["date_last_updated"],
                            $renamedData["roles"],
                            $renamedData["exists_in_reestr"],
                            $biin,
                            $renamedData["rnn"],
                            $renamedData["namekz"],
                            $renamedData["nameru"],
                            $renamedData["resident"],
                            $renamedData["kato"],
                            $renamedData["region"],
                            $renamedData["website"],
                            $renamedData["email"],
                            $renamedData["phone"],
                            $renamedData["number_id"],
                            $renamedData["date_registration"],
                            $renamedData["admin_reporting"],

                        );
                        echo '+ + add:' . " /" . $isAdd . '/ ' . $biin . ' /'.$renamedData['email'].'/' .$renamedData['phone'].'/'. $renamedData['nameru'] . "\n";
                        $countAdd++;
                    } else {
                        $companyTarget = $companyModel->getCompanyByBin($biin);
                        $region = $renamedData['region'] !== '' ? $renamedData['region'] : $companyTarget['region'];
                        $email = $renamedData['email'] !== null ? $renamedData['email'] . ' ' . $companyTarget['email'] : $renamedData['email'];
                        $phone = $companyTarget['phone'] !== null ? $renamedData['phone'] . ' ' . $companyTarget['phone'] : $renamedData['phone'];

                        $isUpdated = $companyModel->updateCompanyGOSZAKUP(
                            $companyTarget['company_bin'],
                            $renamedData['rnn'],
                            $renamedData['date_last_updated'],
                            $renamedData['namekz'],
                            $renamedData['kato'],
                            $region,
                            $renamedData['website'],
                            $email,
                            $phone,
                            $renamedData['number_id'],
                            $renamedData['date_registration']
                        );
                        if ($isUpdated) {
                            echo '- - update:' . $biin . ' | email:' . $renamedData['email'] . ":| phone:" . $renamedData['phone'] . ":| r:" . $region . ':|' . $renamedData['nameru'] . "\n";
                            $countUpdated++;
                        } else {
                            echo 'no update - - - *' . $biin .PHP_EOL;
                            var_dump('data>>',$data);
                            var_dump('$renamedData>>',$renamedData);
                            var_dump('$companyTarget>>',$companyTarget);
                        }
                    }
                } else {
                    echo 'no no filter' . $page . PHP_EOL;
                    $countNoFitler++;
                }
//                if($key % 2 == 0){
//                }
                sleep(1);
            }

            echo "-------------------- offset:  ($offset)}" . PHP_EOL;
            echo ' ------------------- updated: ' . $countUpdated . ' ----- add: ' . $countAdd . ' / count no filter:' . $countNoFitler . ' / ' . PHP_EOL;
            $offset += $limit;
        } while ($offset <= 487000);
        exit();
    }

    /**
     * @throws GuzzleException
     */
    public function request(string $path, array $get = null, array $post = null): string
    {
        $uri = self::HOST . '/' . ltrim($path, '/');
        if ($get !== null) {
            $uri .= '?' . http_build_query($get);
        }

        $this->last_request_uri = $uri;
        $response = $this->client->request($post === null ? 'GET' : 'POST', $uri, [
            RequestOptions::HEADERS => [
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
                'Accept-Encoding' => 'gzip, deflate, br',
                'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
                'Cache-Control' => 'no-cache',
                'Connection' => 'keep-alive',
                'Cookie' => 'ci_session=a%3A4%3A%7Bs%3A10%3A%5C%22session_id%5C%22%3Bs%3A32%3A%5C%22ac68d1cc275f3346cfc1cc1988e204ad%5C%22%3Bs%3A10%3A%5C%22ip_address%5C%22%3Bs%3A7%3A%5C%220.0.0.0%5C%22%3Bs%3A10%3A%5C%22user_agent%5C%22%3Bs%3A101%3A%5C%22Mozilla%2F5.0+%28X11%3B+Linux+x86_64%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F117.0.0.0+Safari%2F537.36%5C%22%3Bs%3A13%3A%5C%22last_activity%5C%22%3Bi%3A1695714066%3B%7D6ced8cd17bfa390db7e3b593dd275c5d',
                'Host' => 'www.goszakup.gov.kz',
                'Pragma' => 'no-cache',
                'Sec-Fetch-Dest' => 'document',
                'Sec-Fetch-Mode' => 'navigate',
                'Sec-Fetch-Site' => 'none',
                'Sec-Fetch-User' => '?1',
                'Upgrade-Insecure-Requests' => '1',
                'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36',
                'sec-ch-ua' => '"Google Chrome";v="117", "Not;A=Brand";v="8", "Chromium";v="117"',
                'sec-ch-ua-mobile' => '?0',
                'sec-ch-ua-platform' => '"Linux"',

            ],
            RequestOptions::CONNECT_TIMEOUT => 7,
            RequestOptions::TIMEOUT => 10,
            RequestOptions::BODY => $post === null ? null : http_build_query($post),
            RequestOptions::VERIFY => false,
        ]);
        return $response->getBody()->getContents();
    }
}
