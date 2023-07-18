<?php

declare(strict_types=1);

namespace App\Controllers\Site;

class SiteInput
{
    protected array $get;
    protected array $post;

    public function __construct(array $get, array $post)
    {
        $this->get = $get;
        $this->post = $post;
    }

    public function getInt(string $name, bool $from_post = false): ?int
    {
        $value = $from_post ? ($this->post[$name] ?? null) : ($this->get[$name] ?? null);
        if (preg_match('|^\d+&|', $value)) {
            return (int)$value;
        }

        return $value;
    }

    public function getString(string $name, bool $from_post = false): ?string
    {
        $value = $from_post ? ($this->post[$name] ?? null) : ($this->get[$name] ?? null);
        $value = trim($value);
        return $value === '' ? null : $value;
    }
}