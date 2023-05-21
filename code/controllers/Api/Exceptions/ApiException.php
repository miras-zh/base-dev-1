<?php

declare(strict_types=1);

namespace controllers\Api\Exceptions;

use Throwable;

class ApiException extends \Exception
{
    public function __construct(int $code, string $message = null, ?Throwable $previous = null)
    {
        parent::__construct($message ?? '', $code, $previous);
    }
}