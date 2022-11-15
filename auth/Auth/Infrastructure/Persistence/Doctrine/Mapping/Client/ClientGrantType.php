<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Persistence\Doctrine\Mapping\Client;

use Auth\Domain\Client\Grant;
use Auth\Shared\Infrastructure\Persistence\Doctrine\Dbal\Type\AbstractJsonType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;

final class ClientGrantType extends AbstractJsonType
{
    private const NAME = 'auth_grant';

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if (null === $value) {
            return null;
        }

        if (!is_array($value)) {
            $message = sprintf('In class %s the values must values of the class %s', __CLASS__, Grant::class);
            throw new \InvalidArgumentException($message);
        }

        try {
            /** @var Grant $val */
            /** @var Grant[] $value */
            $map = array_map(static fn ($val) => $val->value, $value);

            return json_encode($map, JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION);
        } catch (\JsonException $e) {
            throw ConversionException::conversionFailedSerialization($value, 'json', $e->getMessage(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        if (null === $value || '' === $value) {
            return null;
        }

        if (is_resource($value)) {
            $value = stream_get_contents($value);
        }

        try {
            $result = json_decode($value, true, 512, JSON_THROW_ON_ERROR);

            return array_map(static fn ($r) => Grant::from($r), $result);
        } catch (\JsonException $e) {
            throw ConversionException::conversionFailed($value, $this->getName(), $e);
        }
    }
}
