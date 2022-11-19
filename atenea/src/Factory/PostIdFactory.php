<?php

namespace App\Factory;

use Atenea\Posts\Domain\PostId;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<PostId>
 *
 * @method static PostId|Proxy     createOne(array $attributes = [])
 * @method static PostId[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static PostId|Proxy     find(object|array|mixed $criteria)
 * @method static PostId|Proxy     findOrCreate(array $attributes)
 * @method static PostId|Proxy     first(string $sortedField = 'id')
 * @method static PostId|Proxy     last(string $sortedField = 'id')
 * @method static PostId|Proxy     random(array $attributes = [])
 * @method static PostId|Proxy     randomOrCreate(array $attributes = [])
 * @method static PostId[]|Proxy[] all()
 * @method static PostId[]|Proxy[] findBy(array $attributes)
 * @method static PostId[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static PostId[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method        PostId|Proxy     create(array|callable $attributes = [])
 */
final class PostIdFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'value' => self::faker()->uuid(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(PostId $PostId): void {})
        ;
    }

    protected static function getClass(): string
    {
        return PostId::class;
    }
}
