<?php

namespace App\Factory;

use Auth\Domain\User\Password;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Password>
 *
 * @method static Password|Proxy createOne(array $attributes = [])
 * @method static Password[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Password[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Password|Proxy find(object|array|mixed $criteria)
 * @method static Password|Proxy findOrCreate(array $attributes)
 * @method static Password|Proxy first(string $sortedField = 'id')
 * @method static Password|Proxy last(string $sortedField = 'id')
 * @method static Password|Proxy random(array $attributes = [])
 * @method static Password|Proxy randomOrCreate(array $attributes = [])
 * @method static Password[]|Proxy[] all()
 * @method static Password[]|Proxy[] findBy(array $attributes)
 * @method static Password[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Password[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Password|Proxy create(array|callable $attributes = [])
 */
final class PasswordFactory extends ModelFactory
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
            'value' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Password $password): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Password::class;
    }
}
