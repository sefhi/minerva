<?php

namespace App\Factory;

use Auth\Domain\Client\ClientIdentifier;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<ClientIdentifier>
 *
 * @method static ClientIdentifier|Proxy     createOne(array $attributes = [])
 * @method static ClientIdentifier[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ClientIdentifier[]|Proxy[] createSequence(array|callable $sequence)
 * @method static ClientIdentifier|Proxy     find(object|array|mixed $criteria)
 * @method static ClientIdentifier|Proxy     findOrCreate(array $attributes)
 * @method static ClientIdentifier|Proxy     first(string $sortedField = 'id')
 * @method static ClientIdentifier|Proxy     last(string $sortedField = 'id')
 * @method static ClientIdentifier|Proxy     random(array $attributes = [])
 * @method static ClientIdentifier|Proxy     randomOrCreate(array $attributes = [])
 * @method static ClientIdentifier[]|Proxy[] all()
 * @method static ClientIdentifier[]|Proxy[] findBy(array $attributes)
 * @method static ClientIdentifier[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static ClientIdentifier[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method        ClientIdentifier|Proxy     create(array|callable $attributes = [])
 */
final class ClientIdentifierFactory extends ModelFactory
{
    /**
     * @throws \Exception
     */
    protected function getDefaults(): array
    {
        return [
            'value' => hash('md5', random_bytes(16)),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(ClientIdentifier $clientIdentifier): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ClientIdentifier::class;
    }
}
