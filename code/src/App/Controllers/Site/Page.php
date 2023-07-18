<?php

declare(strict_types=1);

namespace App\Controllers\Site;

class Page
{
    public string $title;
    public ?string $description = null;

    /**
     * @var string[]
     */
    public array $keywords = [];

    public string $content = '';

    public function __construct(string $title)
    {
        $this->title = $title;
    }
}