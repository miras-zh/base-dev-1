<?php

declare(strict_types=1);

namespace App\Api;

use App\Api\Exceptions\ApiException;

class ApiController
{
    public static function handleRequest(array $route_parts, array $get, array $post, string|null $input): void
    {
        $params = [];
        if ($get !== []) {
            $params = $get;
        } elseif ($post !== []) {
            $params = $post;
        } elseif ($input !== null) {
            try {
                $input_decoded = json_decode($input, true, flags: JSON_THROW_ON_ERROR);
                if (is_array($input_decoded)) {
                    $params = $input_decoded;
                }
            } catch (\JsonException) {

            }
        }

        try {
            $method_class = self::getMethodClass($route_parts);
            if (!class_exists($method_class)) {
                throw new ApiException(404, 'Method not found');
            }

            try {
                $method_result = $method_class::execute($params);
                $result = [
                    'ok' => true,
                    'result' => $method_result,
                    'error' => null,
                ];
            } catch (\Throwable $exception) {
                throw new ApiException(503, 'Server errror', $exception);
            }
        } catch (ApiException $api_exception) {
            $result = [
                'ok' => false,
                'result' => null,
                'error' => [
                    'code' => $api_exception->getCode(),
                    'message' => $api_exception->getMessage(),
                ],
            ];
        }

        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Expires: ' . date('r'));
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    private static function getMethodClass(array $route_parts): string|ApiMethod
    {
        return '\\App\\Api\\Methods\\' . implode('\\', $route_parts);
    }
}