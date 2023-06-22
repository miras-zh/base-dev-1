<?php

declare(strict_types=1);

namespace Miko\UchetKz;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Kuvardin\DataFilter\DataFilter;
use Kuvardin\KzIdentifiers\Biin;
use RuntimeException;

class Parser
{
    protected const ORG_OPTION_BIIN = 'БИН';
    protected const ORG_OPTION_RNN = 'РНН';
    protected const ORG_OPTION_ADDR = 'ЮРИДИЧЕСКИЙ АДРЕС';
    protected const ORG_OPTION_BOSS = 'РУКОВОДИТЕЛЬ';

    protected const HOST = 'https://pk.uchet.kz';

    protected Client $client;

    public function __construct(
        Client $client,
    )
    {
        $this->client = $client;
    }

    /**
     * @param int|null $page
     * @param string|null $query
     * @param int|null $region
     * @param array $okeds
     * @param string|null $krp
     * @return Models\Organization[]
     */
    public function searchOrganizations(
        int $page = null,
        string $query = null,
        int $region = null,
        array $okeds = [],
        string $krp = null,
    ): array
    {
        $response = $this->request('c/search/', [
            'search' => $query,
            'region' => $region,
            'oked' => $okeds,
            'krp' => $krp,
            'page' => $page ?? 1
        ]);

        if (!preg_match_all(
            '|<div class="company-item container" data-id="(\d+)">(.*?)<div class="company-links">|sui',
            $response,
            $organizations_matches,
            PREG_SET_ORDER,
        )) {
            throw new RuntimeException('Organizations containers not found');
        }


        $organizations = [];
        foreach ($organizations_matches as $organizations_match) {
            $organization_container_html = $organizations_match[0];

            if (!preg_match(
                '|<a href="([^"]*)"\s+class="company-title"\s+title="([^<]+)">|sui',
                $organization_container_html,
                $info_title_match,
            )) {
                throw new RuntimeException('Info title options not found');
            }


            if (!preg_match_all(
                '|<div class="info-item[^"]*">\s*<div class="info-title">([^<]+):</div>\s*<div class="info-value">([^<]+)</div>|sui',
                $organization_container_html,
                $info_options_matches,
                PREG_SET_ORDER,
            )) {
                throw new RuntimeException('Info title options not found');
            }

            if(!preg_match_all('|<div class="info-item">\s*<span class="info-title">(.*?)</span>\s*(&nbsp;)?\s*<span class="info-value">(.+?)</span>|sui',
              $organization_container_html,
            $company_info_items_matches, PREG_SET_ORDER
            )){
                throw new RuntimeException('Info title options not found');
            }

            $company_info_items = [];
            foreach ($company_info_items_matches as $company_info_items_match) {
                $company_info_item_title = DataFilter::getStringEmptyToNull(rtrim(trim($company_info_items_match[1]), ':'), true);
                if ($company_info_item_title === null) {
                    continue;
                } else {
                    $company_info_item_title = mb_strtoupper($company_info_item_title);
                }

                $company_info_item_value = DataFilter::getStringEmptyToNull($company_info_items_match[3], true);
                if ($company_info_item_value === null) {
                    continue;
                }

                $company_info_item_value = preg_replace('|<\s*/?\s*strong\s*>|i', '', $company_info_item_value);
                $company_info_items[$company_info_item_title] = $company_info_item_value;
            }


            $options = [];
            foreach ($info_options_matches as $info_options_match) {
                $options[DataFilter::requireNotEmptyString($info_options_match[1], true)] =
                    DataFilter::requireNotEmptyString($info_options_match[2]);
            }

            $company_name = DataFilter::requireNotEmptyString(html_entity_decode($info_title_match[2]), true);

            if (empty($options[self::ORG_OPTION_BIIN])) {
                throw new RuntimeException('BIIN not found in ' . print_r($options, true));
            }

            $biin_value = $options[self::ORG_OPTION_BIIN];
            $biin = Biin::tryFrom($biin_value);
            if ($biin === null) {
                continue;
            }

            $organizations[] = new Models\Organization(
                biin: $biin,
                name: $company_name,
                rnn: $options[self::ORG_OPTION_RNN] ?? NULL,
                address: $company_info_items[self::ORG_OPTION_ADDR],
                boss: $company_info_items[self::ORG_OPTION_BOSS]
            );
        }

        return  $organizations;
    }

    public function request(string $path, array $get = null, array $post = null): string
    {
        $uri = self::HOST . '/' . ltrim($path, '/');
        if ($get !== null) {
            $uri .= '?' . http_build_query($get);
        }

        $response = $this->client->request($post === null ? 'GET' : 'POST', $uri, [
            RequestOptions::HEADERS => [
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
                'Accept-Encoding' => 'gzip, deflate, br',
                'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
                'Connection' => 'keep-alive',
                'Cookie' => 'PHPSESSID=uHY4yTnskcny0RsCaTJR01LAXgGglIf2; UCHET_SM_GUEST_ID=46682089; UCHET_SM_LAST_VISIT=16.06.2023%2013%3A51%3A09; UCHET_SM_BANNERS=1_595_1_23062023%2C1_484_1_23062023%2C1_465_1_23062023; _gid=GA1.2.1433072370.1686901872; tmr_lvid=be54d3707e219a4e824a1d132b9a3802; tmr_lvidTS=1686901872117; _ym_uid=1686901872763142349; _ym_d=1686901872; _ym_visorc=b; _ym_isad=1; BITRIX_CONVERSION_CONTEXT_s1=%7B%22ID%22%3A63%2C%22EXPIRE%22%3A1686938340%2C%22UNIQUE%22%3A%5B%22conversion_visit_day%22%5D%7D; _ga_3QSV8CVZHW=GS1.1.1686901871.1.0.1686901877.54.0.0; _gat_gtag_UA_30521283_3=1; tmr_detect=1%7C1686901904168; _ga_PEVSH98KN5=GS1.1.1686901881.1.1.1686901904.37.0.0; _ga=GA1.2.1481700947.1686901872',
                'Host' => 'pk.uchet.kz',
                'Referer' => 'https://pk.uchet.kz/c/search/?search=1&region=&oked%5B%5D=&krp=',
                'Sec-Fetch-Dest' => 'document',
                'Sec-Fetch-Mode' => 'navigate',
                'Sec-Fetch-Site' => 'same-origin',
                'Sec-Fetch-User' => '?1',
                'Upgrade-Insecure-Requests' => '1',
                'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
                'sec-ch-ua' => '"Not.A/Brand";v="8", "Chromium";v="114", "Google Chrome";v="114"',
                'sec-ch-ua-mobile' => '?0',
                'sec-ch-ua-platform' => '"Linux"',
            ],
            RequestOptions::CONNECT_TIMEOUT => 7,
            RequestOptions::TIMEOUT => 10,
            RequestOptions::BODY => $post === null ? null : http_build_query($post),
        ]);

        return $response->getBody()->getContents();
    }
}

//
//<div class="company-item container" data-id="201915">
//                    <a href="/c/bin/140440028795/" class="company-title" title="ТОО &quot;BURNOYE SOLAR-1&quot; (&quot;БУРНОЕ СОЛАР-1&quot;)"><SPAN>ТОО</SPAN> "BURNOYE SOLAR-1" ("БУРНОЕ СОЛАР-1")</a>
//                    <div class="company-main-info">
//                             <div class="info-item">
//                                <div class="info-title">БИН:</div>
//                                <div class="info-value">140440028795</div>
//                            </div>
//
//                            <div class="info-item">
//                                <div class="info-title">РНН:</div>
//                                <div class="info-value">211500263041</div>
//                            </div>
//
//                            <div class="info-item extra">
//                                <div class="info-title">КАТО:</div>
//                                <div class="info-value">314230100</div>
//                            </div>
//                    </div>
//                    <div class="company-info">
//                        <div class="info-item">
//                           <span class="info-title">Юридический адрес:</span>&nbsp;
//                           <span class="info-value"><strong>ЖАМБЫЛСКАЯ ОБЛАСТЬ, ЖУАЛЫНСКИЙ РАЙОН, Б.МОМЫШУЛЫ С.О., С.ИМ.Б.МОМЫШУЛЫ</strong>, УЛИЦА ЖАМБЫЛ, ДОМ 14</span>
//                        </div>
//                       <div class="info-item">
//                                    <span class="info-title">Руководитель:</span>&nbsp;
//                                    <span class="info-value">ГЛАДЬЕВ ЕВГЕНИЙ ВАЛЕРЬЕВИЧ</span>
//                                </div>
//
//                        <div class="info-item">
//                                                                                </div>
//
//                    </div>
//
//                    <div class="company-links">"
