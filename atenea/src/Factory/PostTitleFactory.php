<?php

namespace App\Factory;

use Atenea\Posts\Domain\PostTitle;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<PostTitle>
 *
 * @method static PostTitle|Proxy     createOne(array $attributes = [])
 * @method static PostTitle[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static PostTitle|Proxy     find(object|array|mixed $criteria)
 * @method static PostTitle|Proxy     findOrCreate(array $attributes)
 * @method static PostTitle|Proxy     first(string $sortedField = 'id')
 * @method static PostTitle|Proxy     last(string $sortedField = 'id')
 * @method static PostTitle|Proxy     random(array $attributes = [])
 * @method static PostTitle|Proxy     randomOrCreate(array $attributes = [])
 * @method static PostTitle[]|Proxy[] all()
 * @method static PostTitle[]|Proxy[] findBy(array $attributes)
 * @method static PostTitle[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static PostTitle[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method        PostTitle|Proxy     create(array|callable $attributes = [])
 */
final class PostTitleFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'value' => self::faker()->text(40),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(PostTitle $postTitle): void {})
        ;
    }

    protected static function getClass(): string
    {
        return PostTitle::class;
    }
}
