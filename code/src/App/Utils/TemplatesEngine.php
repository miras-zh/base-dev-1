<?php

declare(strict_types=1);

namespace App\Utils;

use Throwable;

class TemplatesEngine
{
    private function __construct()
    {
    }

    public static function render(string $template_path, array $data): string
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }

        try {
            ob_start();
            require ROOT_DIR . '/templates/' . trim($template_path, '/') . '.php';
            return ob_get_clean();
        } catch (Throwable $exception) {
            ob_get_clean();
            throw $exception;
        }
    }
}