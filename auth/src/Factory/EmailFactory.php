<?php

namespace App\Factory;

use Auth\Domain\User\Email;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Email>
 *
 * @method static Email|Proxy createOne(array $attributes = [])
 * @method static Email[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Email[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Email|Proxy find(object|array|mixed $criteria)
 * @method static Email|Proxy findOrCreate(array $attributes)
 * @method static Email|Proxy first(string $sortedField = 'id')
 * @method static Email|Proxy last(string $sortedField = 'id')
 * @method static Email|Proxy random(array $attributes = [])
 * @method static Email|Proxy randomOrCreate(array $attributes = [])
 * @method static Email[]|Proxy[] all()
 * @method static Email[]|Proxy[] findBy(array $attributes)
 * @method static Email[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Email[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Email|Proxy create(array|callable $attributes = [])
 */
final class EmailFactory extends ModelFactory
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
            // ->afterInstantiate(function(Email $email): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Email::class;
    }
}
