<?php

declare(strict_types=1);

namespace App\OrganizationsParsers;

use App\OrganizationsParsers\Models\OrganizationsList;
use App\OrganizationsParsers\Models\SelectionData;
use GuzzleHttp\Client;

abstract class ParserAbstract
{
    public function __construct(
        protected Client $client,
        protected ?string $token = null,
    )
    {

    }

    abstract public function getOrganizationsList(SelectionData $selection_data = null): OrganizationsList;

    abstract public static function getCode(): string;

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }
}