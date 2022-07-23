<?php

declare(strict_types=1);

namespace Atenea\Shared\Infrastructure\Persistence\Doctrine;

use Atenea\Shared\Domain\ValueObject\AuthorId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;


final class AuthorIdType extends StringType
{
    public function getName(): string
    {
        return 'author_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): AuthorId
    {
        return new AuthorId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        /* @var AuthorId $value */
        return $value->value();
    }
}
