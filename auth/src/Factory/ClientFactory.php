<?php

namespace App\Factory;

use Auth\Domain\Client\Client;
use Ramsey\Uuid\Uuid;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Client>
 *
 * @method static Client|Proxy createOne(array $attributes = [])
 * @method static Client[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Client[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Client|Proxy find(object|array|mixed $criteria)
 * @method static Client|Proxy findOrCreate(array $attributes)
 * @method static Client|Proxy first(string $sortedField = 'id')
 * @method static Client|Proxy last(string $sortedField = 'id')
 * @method static Client|Proxy random(array $attributes = [])
 * @method static Client|Proxy randomOrCreate(array $attributes = [])
 * @method static Client[]|Proxy[] all()
 * @method static Client[]|Proxy[] findBy(array $attributes)
 * @method static Client[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Client[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Client|Proxy create(array|callable $attributes = [])
 */
final class ClientFactory extends ModelFactory
{

    protected function getDefaults(): array
    {
        return [
            'id' => Uuid::uuid4(),
            'active' => self::faker()->boolean(),
            'credentials' => ClientCredentialsParamFactory::createOne(),
            'grants' => ['client_credentials', 'password']
        ];
    }

    public function withGrantClientCredentials(): self
    {
        return $this->addState(
            [
                'grants' => ['client_credentials'],
                'active' => true,
            ]
        );
    }

    public function withGrantPassword(): self
    {
        return $this->addState(
            [
                'grants' => ['password'],
                'active' => true,
            ]
        );
    }

    public function withGrantRefreshToken(): self
    {
        return $this->addState(
            [
                'grants' => ['password', 'refresh_token'],
                'active' => true,
            ]
        );
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this// ->afterInstantiate(function(Client $client): void {})
            ;
    }

    protected static function getClass(): string
    {
        return Client::class;
    }
}
