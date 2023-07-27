<?php

declare(strict_types=1);

namespace App\OrganizationsParsers;

use App\OrganizationsParsers\Parsers;
use GuzzleHttp\Client;
use RuntimeException;

class ParsersController
{
    /**
     * @type ParserAbstract[]|string[]
     */
    public const ALL = [
        Parsers\EgovData::class,
        Parsers\Uchet::class,
        Parsers\FindPhone::class
    ];

    public static function getParser(string $code, Client $client, string $token = null): ParserAbstract
    {
        foreach (self::ALL as $parser_class) {
            if ($parser_class::getCode() === $code) {
                return new $parser_class($client, $token);
            }
        }

        throw new RuntimeException("Parser with code $code not found");
    }
}