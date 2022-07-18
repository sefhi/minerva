<?php

declare(strict_types=1);

namespace Atenea\Shared\Domain\Exceptions;

use Exception;

class AuthorNotFoundException extends Exception
{
    protected $code = 404;
    protected $message = 'Author not found by id %s';

    public function __construct(int $id)
    {
        parent::__construct(sprintf($this->message, $id), $this->code);
    }
}
