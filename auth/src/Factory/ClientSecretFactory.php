<?php

namespace App\Factory;

use Auth\Domain\Client\ClientSecret;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<ClientSecret>
 *
 * @method static ClientSecret|Proxy     createOne(array $attributes = [])
 * @method static ClientSecret[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ClientSecret[]|Proxy[] createSequence(array|callable $sequence)
 * @method static ClientSecret|Proxy     find(object|array|mixed $criteria)
 * @method static ClientSecret|Proxy     findOrCreate(array $attributes)
 * @method static ClientSecret|Proxy     first(string $sortedField = 'id')
 * @method static ClientSecret|Proxy     last(string $sortedField = 'id')
 * @method static ClientSecret|Proxy     random(array $attributes = [])
 * @method static ClientSecret|Proxy     randomOrCreate(array $attributes = [])
 * @method static ClientSecret[]|Proxy[] all()
 * @method static ClientSecret[]|Proxy[] findBy(array $attributes)
 * @method static ClientSecret[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static ClientSecret[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method        ClientSecret|Proxy     create(array|callable $attributes = [])
 */
final class ClientSecretFactory extends ModelFactory
{
    /**
     * @throws \Exception
     */
    protected function getDefaults(): array
    {
        return [
            'value' => hash('sha512', random_bytes(32)),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(ClientSecret $clientSecret): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ClientSecret::class;
    }
}
