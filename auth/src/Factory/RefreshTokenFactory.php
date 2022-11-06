<?php

namespace App\Factory;

use Auth\Domain\RefreshToken\RefreshToken;
use Auth\Domain\Token\Token;
use Ramsey\Uuid\Uuid;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<RefreshToken>
 *
 * @method static RefreshToken|Proxy createOne(array $attributes = [])
 * @method static RefreshToken[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static RefreshToken[]|Proxy[] createSequence(array|callable $sequence)
 * @method static RefreshToken|Proxy find(object|array|mixed $criteria)
 * @method static RefreshToken|Proxy findOrCreate(array $attributes)
 * @method static RefreshToken|Proxy first(string $sortedField = 'id')
 * @method static RefreshToken|Proxy last(string $sortedField = 'id')
 * @method static RefreshToken|Proxy random(array $attributes = [])
 * @method static RefreshToken|Proxy randomOrCreate(array $attributes = [])
 * @method static RefreshToken[]|Proxy[] all()
 * @method static RefreshToken[]|Proxy[] findBy(array $attributes)
 * @method static RefreshToken[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static RefreshToken[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method RefreshToken|Proxy create(array|callable $attributes = [])
 */
final class RefreshTokenFactory extends ModelFactory
{

    protected function getDefaults(): array
    {
        return [
            'id' => Uuid::uuid4(),
            'token' => TokenFactory::createOne(),
            'expiry' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'revoked' => false,
        ];
    }

    public function withToken(Token $token) : self {
        return $this->addState(
            [
                'token' => $token
            ]
        );
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(RefreshToken $refreshToken): void {})
        ;
    }

    protected static function getClass(): string
    {
        return RefreshToken::class;
    }
}
