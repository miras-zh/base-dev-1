<?php

declare(strict_types=1);

namespace App\Controllers\Site;

class SiteController
{
    public static function handleRequest(string $route, array $_GET, array $_POST): void
    {

        // Создать PageInput
        // Получить класс страницы
        // Обработать запрос
        // Поместить результат в главный шаблон
        // Вывести результат

    }

    private static function getHandlerClass(array $route_parts): PageController|string
    {
        if (empty($route_parts[0])) {
            $route_parts[0] = 'index';
        }

        $result = 'App\\Controllers\\Site\\PageControllers\\';
        foreach ($route_parts as $route_part) {
            $words = explode('_', $route_part);
            foreach ($words as $word) {
                $result .= ucfirst($word);
            }
            $result .= '\\';
        }

        return rtrim($result, '\\');
    }
}