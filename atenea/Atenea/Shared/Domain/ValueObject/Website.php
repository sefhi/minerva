<?php

declare(strict_types=1);

namespace Atenea\Shared\Domain\ValueObject;

use Atenea\Shared\Domain\ValueObject\Primitive\StringValueObject;

class Website extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->checkValidUrlWeb();
    }

    private function checkValidUrlWeb(): void
    {
        if (!filter_var($this->value, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException(sprintf('Web Url %s is not valid in %s', $this->value, __CLASS__), 400);
        }
    }
}
