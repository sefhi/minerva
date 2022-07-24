<?php

declare(strict_types=1);

namespace Atenea\Posts\Infrastructure\Persistence\Doctrine;

use Atenea\Posts\Domain\PostId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\StringType;

final class PostIdType extends StringType
{
    public function getName(): string
    {
        return 'post_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): PostId
    {
        return new PostId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        /* @var PostId $value */
        return $value->value();
    }
}
