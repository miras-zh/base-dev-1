<?php

declare(strict_types=1);

namespace controllers\Api;

use controllers\Api\Exceptions\ApiException;

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



            var_dump('$method_class:',$method_class);
            echo '<br/>';
            if (!class_exists($method_class)) {
                throw new ApiException(404, 'Method not found');
            }

            try {
                $method_result = $method_class::execute($params);
                var_dump('----------------------------- $method_result:',$method_result);
                echo '<br/>';
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
        return '\\controllers\\Api\\Methods\\' . implode('\\', $route_parts);
    }
}