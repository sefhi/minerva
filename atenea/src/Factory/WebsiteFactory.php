<?php

namespace App\Factory;

use Atenea\Shared\Domain\ValueObject\Website;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Website>
 *
 * @method static        Website|Proxy createOne(array $attributes = [])
 * @method static        Website[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static        Website|Proxy find(object|array|mixed $criteria)
 * @method static        Website|Proxy findOrCreate(array $attributes)
 * @method static        Website|Proxy first(string $sortedField = 'id')
 * @method static        Website|Proxy last(string $sortedField = 'id')
 * @method static        Website|Proxy random(array $attributes = [])
 * @method static        Website|Proxy randomOrCreate(array $attributes = [])
 * @method static        Website[]|Proxy[] all()
 * @method static        Website[]|Proxy[] findBy(array $attributes)
 * @method static        Website[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static        Website[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Website|Proxy create(array|callable $attributes = [])
 */
final class WebsiteFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'value' => self::faker()->url(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Website $website): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Website::class;
    }
}
