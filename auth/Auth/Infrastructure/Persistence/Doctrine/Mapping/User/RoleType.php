<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Persistence\Doctrine\Mapping\User;

use Auth\Domain\User\Role;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\JsonType;
use InvalidArgumentException;
use JsonException;

final class RoleType extends JsonType
{

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        if (!is_array($value)) {
            $message = sprintf('In class %s the values must values of the class %s', __CLASS__, Role::class);
            throw new InvalidArgumentException($message);
        }

        try {
            $map = array_map(static fn($val) => $val->value(), $value);
            return json_encode($map, JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION);
        } catch (JsonException $e) {
            throw ConversionException::conversionFailedSerialization($value, 'json', $e->getMessage(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_resource($value)) {
            $value = stream_get_contents($value);
        }

        try {
            $result = json_decode($value, true, 512, JSON_THROW_ON_ERROR);
            return array_map(static fn($r) => new Role($r), $result);
        } catch (JsonException $e) {
            throw ConversionException::conversionFailed($value, $this->getName(), $e);
        }
    }
}