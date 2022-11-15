<?php

namespace App\Factory;

use Auth\Domain\User\Email;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Email>
 *
 * @method static Email|Proxy     createOne(array $attributes = [])
 * @method static Email[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Email[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Email|Proxy     find(object|array|mixed $criteria)
 * @method static Email|Proxy     findOrCreate(array $attributes)
 * @method static Email|Proxy     first(string $sortedField = 'id')
 * @method static Email|Proxy     last(string $sortedField = 'id')
 * @method static Email|Proxy     random(array $attributes = [])
 * @method static Email|Proxy     randomOrCreate(array $attributes = [])
 * @method static Email[]|Proxy[] all()
 * @method static Email[]|Proxy[] findBy(array $attributes)
 * @method static Email[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Email[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method        Email|Proxy     create(array|callable $attributes = [])
 */
final class EmailFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'value' => self::faker()->email(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Email $email): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Email::class;
    }
}
