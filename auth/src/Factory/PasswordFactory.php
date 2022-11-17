<?php

namespace App\Factory;

use Auth\Domain\User\Password;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Password>
 *
 * @method static Password|Proxy     createOne(array $attributes = [])
 * @method static Password[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Password[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Password|Proxy     find(object|array|mixed $criteria)
 * @method static Password|Proxy     findOrCreate(array $attributes)
 * @method static Password|Proxy     first(string $sortedField = 'id')
 * @method static Password|Proxy     last(string $sortedField = 'id')
 * @method static Password|Proxy     random(array $attributes = [])
 * @method static Password|Proxy     randomOrCreate(array $attributes = [])
 * @method static Password[]|Proxy[] all()
 * @method static Password[]|Proxy[] findBy(array $attributes)
 * @method static Password[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Password[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method        Password|Proxy     create(array|callable $attributes = [])
 */
final class PasswordFactory extends ModelFactory
{
    public const PASSWORD = 'qwerty69';

    protected function getDefaults(): array
    {
        return [
            'value' => self::PASSWORD,
        ];
    }

    protected function initialize(): self
    {
        return $this;
    }

    protected static function getClass(): string
    {
        return Password::class;
    }
}
