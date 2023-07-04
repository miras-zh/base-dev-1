<?php

declare(strict_types=1);

namespace Miko\EgovData;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Api
 *
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Api
{
    public const HOST = 'https://data.egov.kz';

    protected Client $client;
    protected string $api_key;

    public ?ResponseInterface $last_response = null;
    public ?string $last_request_uri = null;

    public int $request_timeout = 10;
    public int $connect_timeout = 10;
    public string $user_agent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) ' .
    'Chrome/98.0.4758.102 Safari/537.36';

    public function __construct(Client $client, string $api_key)
    {
        $this->client = $client;
        $this->api_key = $api_key;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getApiKey(): string
    {
        return $this->api_key;
    }

    /**
     * @throws GuzzleException
     */
    public function getData(string $method, int $size = null, int $from = null, array $query = null): array
    {
        $source = [];

        if ($size !== null) {
            $source['size'] = $size;
        }

        if ($from !== null) {
            $source['from'] = $from;
        }

        if ($query !== null) {
            $source['query'] = $query;
        }

        return $this->request("api/$method", [
            'source' => $source === [] ? null : json_encode($source, JSON_THROW_ON_ERROR),
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function request(string $path, array $get = null, array $post = null): array
    {
        if ($get === null) {
            $get = ['apiKey' => $this->api_key];
        } else {
            $get['apiKey'] = $this->api_key;
        }

        $uri = self::HOST . '/' . $path . '?' . http_build_query($get);

        $this->last_response = null;
        $this->last_request_uri = $uri;

        $response = $this->client->request($post === null ? 'GET' : 'POST', $uri, [
            RequestOptions::TIMEOUT => $this->request_timeout,
            RequestOptions::CONNECT_TIMEOUT => $this->connect_timeout,
            RequestOptions::FORM_PARAMS => $post,
            RequestOptions::VERIFY => false,
            RequestOptions::HEADERS => [
                'Pragma' => 'no-cache',
                'Cache-Control' => 'no-cache',
                'Upgrade-Insecure-Requests' => '1',
                'User-Agent' => $this->user_agent,
                'Accept' => '*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                'Referer' => self::HOST,
                'Accept-Encoding' => 'gzip, deflate',
                'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
                'X-Requested-With' => 'XMLHttpRequest',
            ],
        ]);

        $this->last_response = $response;
        $contents = $response->getBody()->getContents();

        $decoded = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        return $decoded;
    }
}