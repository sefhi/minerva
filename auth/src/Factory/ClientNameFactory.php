<?php

namespace App\Factory;

use Auth\Domain\Client\ClientName;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<ClientName>
 *
 * @method static ClientName|Proxy createOne(array $attributes = [])
 * @method static ClientName[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ClientName[]|Proxy[] createSequence(array|callable $sequence)
 * @method static ClientName|Proxy find(object|array|mixed $criteria)
 * @method static ClientName|Proxy findOrCreate(array $attributes)
 * @method static ClientName|Proxy first(string $sortedField = 'id')
 * @method static ClientName|Proxy last(string $sortedField = 'id')
 * @method static ClientName|Proxy random(array $attributes = [])
 * @method static ClientName|Proxy randomOrCreate(array $attributes = [])
 * @method static ClientName[]|Proxy[] all()
 * @method static ClientName[]|Proxy[] findBy(array $attributes)
 * @method static ClientName[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static ClientName[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method ClientName|Proxy create(array|callable $attributes = [])
 */
final class ClientNameFactory extends ModelFactory
{

    protected function getDefaults(): array
    {
        return [
            'value' => self::faker()->company(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(ClientName $clientName): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ClientName::class;
    }
}
