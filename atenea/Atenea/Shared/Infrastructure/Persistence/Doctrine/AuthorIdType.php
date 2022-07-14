<?php

declare(strict_types=1);

namespace Atenea\Shared\Infrastructure\Persistence\Doctrine;

use Atenea\Shared\Domain\ValueObject\Author\AuthorId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

final class AuthorIdType extends IntegerType
{
    public function getName(): string
    {
        return 'author_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): AuthorId
    {
        return new AuthorId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        /* @var AuthorId $value */
        return $value->value();
    }
}
