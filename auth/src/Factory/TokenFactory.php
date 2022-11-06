<?php

namespace App\Factory;

use Auth\Domain\Client\Client;
use Auth\Domain\Token\Token;
use Auth\Domain\User\User;
use DateInterval;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Token>
 *
 * @method static Token|Proxy createOne(array $attributes = [])
 * @method static Token[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Token[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Token|Proxy find(object|array|mixed $criteria)
 * @method static Token|Proxy findOrCreate(array $attributes)
 * @method static Token|Proxy first(string $sortedField = 'id')
 * @method static Token|Proxy last(string $sortedField = 'id')
 * @method static Token|Proxy random(array $attributes = [])
 * @method static Token|Proxy randomOrCreate(array $attributes = [])
 * @method static Token[]|Proxy[] all()
 * @method static Token[]|Proxy[] findBy(array $attributes)
 * @method static Token[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Token[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Token|Proxy create(array|callable $attributes = [])
 */
final class TokenFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        $expiry = new DateTimeImmutable();

        return [
            'id' => Uuid::uuid4(),
            'client' => ClientFactory::createOne(),
            'user' => UserFactory::createOne(),
            'expiry' => $expiry->add(new DateInterval('PT2H')),
            'revoked' => false,
        ];
    }

    public function withUser(User $user) : self
    {
        return $this->addState(
            [
                'client' => ClientFactory::new()->withGrantRefreshToken(),
                'user' => $user,
            ]
        );
    }
    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Token $token): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Token::class;
    }
}
