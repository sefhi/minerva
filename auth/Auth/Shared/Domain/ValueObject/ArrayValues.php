<?php

namespace Auth\Shared\Domain\ValueObject;

interface ArrayValues
{
    /**
     * @return array
     */
    public function getValues(): array;
}