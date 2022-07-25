<?php

namespace App\Factory;

use Atenea\Shared\Domain\ValueObject\AuthorId;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<AuthorId>
 *
 * @method static         AuthorId|Proxy createOne(array $attributes = [])
 * @method static         AuthorId[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static         AuthorId|Proxy find(object|array|mixed $criteria)
 * @method static         AuthorId|Proxy findOrCreate(array $attributes)
 * @method static         AuthorId|Proxy first(string $sortedField = 'id')
 * @method static         AuthorId|Proxy last(string $sortedField = 'id')
 * @method static         AuthorId|Proxy random(array $attributes = [])
 * @method static         AuthorId|Proxy randomOrCreate(array $attributes = [])
 * @method static         AuthorId[]|Proxy[] all()
 * @method static         AuthorId[]|Proxy[] findBy(array $attributes)
 * @method static         AuthorId[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static         AuthorId[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method AuthorId|Proxy create(array|callable $attributes = [])
 */
final class AuthorIdFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'value' => self::faker()->uuid(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(AuthorId $authorId): void {})
            ;
    }

    protected static function getClass(): string
    {
        return AuthorId::class;
    }
}
