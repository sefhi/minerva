<?php

declare(strict_types=1);

namespace Atenea\Shared\Domain\Criteria;

/**
 * @method static FilterOperator gt()
 * @method static FilterOperator lt()
 * @method static FilterOperator like()
 */
enum FilterOperator: string
{
    case EQUAL = '=';
    case NOT_EQUAL = '!=';
    case GT = '>';
    case LT = '<';
    case CONTAINS = 'CONTAINS';
    case NOT_CONTAINS = 'NOT_CONTAINS';

    private static function getContaining(): array
    {
        return [self::CONTAINS, self::NOT_CONTAINS];
    }

    public function isContaining(): bool
    {
        return in_array($this, self::getContaining(), true);
    }
}
