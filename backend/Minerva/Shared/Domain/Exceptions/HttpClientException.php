<?php

declare(strict_types=1);

namespace Minerva\Shared\Domain\Exceptions;

use Exception;

class HttpClientException extends Exception
{
    protected $code = 500;
    protected $message = 'httpclient error `%s`';

    public function __construct(string $error)
    {
        parent::__construct(sprintf($this->message, $error), $this->code);
    }
}