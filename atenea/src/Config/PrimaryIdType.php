<?php

declare(strict_types=1);

namespace App\Config;

use Doctrine\DBAL\Types\StringType;

final class PrimaryIdType extends StringType
{
    public function getName(): string
    {
        return 'primary_id';
    }
}
