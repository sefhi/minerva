<?php

namespace App\Factory;

use League\Bundle\OAuth2ServerBundle\Model\AuthorizationCode;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<AuthorizationCode>
 *
 * @method static AuthorizationCode|Proxy createOne(array $attributes = [])
 * @method static AuthorizationCode[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static AuthorizationCode[]|Proxy[] createSequence(array|callable $sequence)
 * @method static AuthorizationCode|Proxy find(object|array|mixed $criteria)
 * @method static AuthorizationCode|Proxy findOrCreate(array $attributes)
 * @method static AuthorizationCode|Proxy first(string $sortedField = 'id')
 * @method static AuthorizationCode|Proxy last(string $sortedField = 'id')
 * @method static AuthorizationCode|Proxy random(array $attributes = [])
 * @method static AuthorizationCode|Proxy randomOrCreate(array $attributes = [])
 * @method static AuthorizationCode[]|Proxy[] all()
 * @method static AuthorizationCode[]|Proxy[] findBy(array $attributes)
 * @method static AuthorizationCode[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static AuthorizationCode[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method AuthorizationCode|Proxy create(array|callable $attributes = [])
 */
final class AuthorizationCodeFactory extends ModelFactory
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
            // ->afterInstantiate(function(AuthorizationCode $authorizationCode): void {})
        ;
    }

    protected static function getClass(): string
    {
        return AuthorizationCode::class;
    }
}
