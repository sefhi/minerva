<?php

namespace App\Factory;

use Auth\Domain\Token\Token;
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
            // ->afterInstantiate(function(Token $token): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Token::class;
    }
}
