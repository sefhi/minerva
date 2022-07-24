<?php

namespace App\Factory;

use Atenea\Shared\Domain\ValueObject\Name;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Name>
 *
 * @method static     Name|Proxy createOne(array $attributes = [])
 * @method static     Name[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static     Name|Proxy find(object|array|mixed $criteria)
 * @method static     Name|Proxy findOrCreate(array $attributes)
 * @method static     Name|Proxy first(string $sortedField = 'id')
 * @method static     Name|Proxy last(string $sortedField = 'id')
 * @method static     Name|Proxy random(array $attributes = [])
 * @method static     Name|Proxy randomOrCreate(array $attributes = [])
 * @method static     Name[]|Proxy[] all()
 * @method static     Name[]|Proxy[] findBy(array $attributes)
 * @method static     Name[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static     Name[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Name|Proxy create(array|callable $attributes = [])
 */
final class NameFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'value' => self::faker()->name(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Name $name): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Name::class;
    }
}
