<?php

declare(strict_types=1);

namespace Atenea\Shared\Domain\Criteria;

enum OrderType: string
{
    case ASC = 'asc';
    case DESC = 'desc';
    case NONE = 'none';

    public function isNone(): bool
    {
        return self::NONE === $this;
    }
}
