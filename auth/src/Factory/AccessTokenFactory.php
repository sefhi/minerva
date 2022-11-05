<?php

namespace App\Factory;

use League\Bundle\OAuth2ServerBundle\Model\AccessToken;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<AccessToken>
 *
 * @method static AccessToken|Proxy createOne(array $attributes = [])
 * @method static AccessToken[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static AccessToken[]|Proxy[] createSequence(array|callable $sequence)
 * @method static AccessToken|Proxy find(object|array|mixed $criteria)
 * @method static AccessToken|Proxy findOrCreate(array $attributes)
 * @method static AccessToken|Proxy first(string $sortedField = 'id')
 * @method static AccessToken|Proxy last(string $sortedField = 'id')
 * @method static AccessToken|Proxy random(array $attributes = [])
 * @method static AccessToken|Proxy randomOrCreate(array $attributes = [])
 * @method static AccessToken[]|Proxy[] all()
 * @method static AccessToken[]|Proxy[] findBy(array $attributes)
 * @method static AccessToken[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static AccessToken[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method AccessToken|Proxy create(array|callable $attributes = [])
 */
final class AccessTokenFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'expiry' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'revoked' => self::faker()->boolean(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(AccessToken $accessToken): void {})
        ;
    }

    protected static function getClass(): string
    {
        return AccessToken::class;
    }
}
