<?php

namespace App\Factory;

use Auth\Domain\Client\ClientCredentialsParam;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<ClientCredentialsParam>
 *
 * @method static ClientCredentialsParam|Proxy     createOne(array $attributes = [])
 * @method static ClientCredentialsParam[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ClientCredentialsParam[]|Proxy[] createSequence(array|callable $sequence)
 * @method static ClientCredentialsParam|Proxy     find(object|array|mixed $criteria)
 * @method static ClientCredentialsParam|Proxy     findOrCreate(array $attributes)
 * @method static ClientCredentialsParam|Proxy     first(string $sortedField = 'id')
 * @method static ClientCredentialsParam|Proxy     last(string $sortedField = 'id')
 * @method static ClientCredentialsParam|Proxy     random(array $attributes = [])
 * @method static ClientCredentialsParam|Proxy     randomOrCreate(array $attributes = [])
 * @method static ClientCredentialsParam[]|Proxy[] all()
 * @method static ClientCredentialsParam[]|Proxy[] findBy(array $attributes)
 * @method static ClientCredentialsParam[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static ClientCredentialsParam[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method        ClientCredentialsParam|Proxy     create(array|callable $attributes = [])
 */
final class ClientCredentialsParamFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'identifier' => ClientIdentifierFactory::createOne(),
            'name' => ClientNameFactory::createOne(),
            'secret' => ClientSecretFactory::createOne(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(ClientCredentialsParam $clientCredentialsParam): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ClientCredentialsParam::class;
    }
}
