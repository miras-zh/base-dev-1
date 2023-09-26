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
        $num = 1;
        do {


            $page = $this->request('ru/registry/supplierreg', [
                'count_record' => $selection_data?->limit ?? 50,
                'page' => $num,
            ]);

            if (preg_match_all('/<td[^>]*>\s*<a href="([^"]+)"/', $page, $matches)) {
                foreach ($matches[1] as $key => $match) {
                    if (strpos($match, 'supplierreg?filter[other]') === false) {
                        $item_page = $this->request($match);

                        if (preg_match_all('/<tr>\s*<th>(.*?)<\/th>\s*<td>(.*?)<\/td>\s*<\/tr>/s', $item_page, $matches2)) {
                            $data = array_combine($matches2[1], $matches2[2]);
                            // Создаем ассоциативный массив для переименованных ключей
                            $renamedData = array(
                                "date_last_updated" => $data["Дата последнего обновления"],
                                "roles" => $data["Роли участника"],
                                "exists_in_reestr" => $data["Состоит в реестре государственных заказчиков"],
                                "bin" => $data["БИН участника"],
                                "rnn" => $data["РНН участника"],
                                "namekz" => $data["Наименование на каз. языке"],
                                "nameru" => $data["Наименование на рус. языке"],
                                "resident" => $data["Резиденство"],
                                "kato" => $data["КАТО"],
                                "region" => $data["Регион"],
                                "website" => $data["Вебсайт:"],
                                "email" => $data["E-Mail:"],
                                "phone" => $data["Контактный телефон:"],
                                "number_id" => $data["Серия свидетельства (для ИП) и номер свидетельства о государственной регистрации"],
                                "date_registration" => $data["Дата свидетельства о государственной регистрации"],
                                "admin_reporting" => $data["Наименование администратора(ов) отчетности"],
                            );
                            print_r($renamedData);



                        }
                        if (($key % 50) == 0) {
                            sleep(10);
                            var_dump( "-------------------------------------------- 100 <br>");
                        }
                    }
                }
            }
            $num++;
            var_dump('num:', $num);
        }while($num <= 9673);
    }

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