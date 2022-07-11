<?php

declare(strict_types=1);

use Atenea\Posts\Domain\PostId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

final class PostIdType extends IntegerType
{
    public function getName(): string
    {
        return PostId::class;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): PostId
    {
        return new PostId($value);
    }
}
