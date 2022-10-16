<?php

declare(strict_types=1);

namespace Auth\Shared\Infrastructure\Persistence\Doctrine\Dbal\Type;

use Auth\Shared\Domain\ValueObject\ArrayValues;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\JsonType;
use JsonException;

class AbstractJsonType extends JsonType
{
    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var ArrayValues $values */
        if ($value === null) {
            return null;
        }

        try {
            return json_encode($value->getValues(), JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION);
        } catch (JsonException $e) {
            throw ConversionException::conversionFailedSerialization($value, 'json', $e->getMessage(), $e);
        }
    }
}