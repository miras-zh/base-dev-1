<?php

namespace src;

use Exception;
use RuntimeException;

class App
{
    public static function getRandomString(int $length, string $alphabet = null): string
    {
        if ($length < 1) {
            throw new RuntimeException('String length must pe positive number');
        }

        $alphabet ??= 'abcdefghijklmnopqrstuvwxyz0123456789';
        $alphabet_length = mb_strlen($alphabet);
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            try {
                $result .= mb_substr($alphabet, random_int(0, $alphabet_length - 1), 1);
            } catch (Exception $e) {
                throw new RuntimeException($e->getMessage(), $e->getCode(), $e->getPrevious());
            }
        }

        return $result;
    }
}
