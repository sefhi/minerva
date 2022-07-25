<?php

namespace App\Factory;

use Atenea\Shared\Domain\ValueObject\Username;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Username>
 *
 * @method static         Username|Proxy createOne(array $attributes = [])
 * @method static         Username[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static         Username|Proxy find(object|array|mixed $criteria)
 * @method static         Username|Proxy findOrCreate(array $attributes)
 * @method static         Username|Proxy first(string $sortedField = 'id')
 * @method static         Username|Proxy last(string $sortedField = 'id')
 * @method static         Username|Proxy random(array $attributes = [])
 * @method static         Username|Proxy randomOrCreate(array $attributes = [])
 * @method static         Username[]|Proxy[] all()
 * @method static         Username[]|Proxy[] findBy(array $attributes)
 * @method static         Username[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static         Username[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Username|Proxy create(array|callable $attributes = [])
 */
final class UsernameFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'value' => self::faker()->userName(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Username $username): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Username::class;
    }
}
