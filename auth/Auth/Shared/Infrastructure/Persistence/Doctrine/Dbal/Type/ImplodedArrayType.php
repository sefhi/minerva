<?php

declare(strict_types=1);

namespace Auth\Shared\Infrastructure\Persistence\Doctrine\Dbal\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;


abstract class ImplodedArrayType extends TextType
{
    /**
     * @var string
     */
    private const VALUE_DELIMITER = ' ';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (!\is_array($value)) {
            throw new \LogicException('This type can only be used in combination with arrays.');
        }

        if (0 === \count($value)) {
            return null;
        }

        foreach ($value as $item) {
            $this->assertValueCanBeImploded($item);
        }

        return implode(self::VALUE_DELIMITER, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): array
    {
        if (null === $value) {
            return [];
        }

        \assert(\is_string($value), 'Expected $value of be either a string or null.');

        $values = explode(self::VALUE_DELIMITER, $value);

        return $this->convertDatabaseValues($values);
    }

    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        $column['length'] = 65535;

        return parent::getSQLDeclaration($column, $platform);
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    private function assertValueCanBeImploded($value): void
    {
        if (null === $value) {
            return;
        }

        if (\is_scalar($value)) {
            return;
        }

        if (\is_object($value) && method_exists($value, '__toString')) {
            return;
        }

        throw new \InvalidArgumentException(sprintf('The value of \'%s\' type cannot be imploded.', \gettype($value)));
    }

    /**
     * @param array $values
     *
     * @return array
     */
    abstract protected function convertDatabaseValues(array $values): array;
}
