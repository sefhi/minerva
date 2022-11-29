<?php

namespace App\Factory;

use Atenea\Posts\Domain\PostContent;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<PostContent>
 *
 * @method static PostContent|Proxy     createOne(array $attributes = [])
 * @method static PostContent[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static PostContent|Proxy     find(object|array|mixed $criteria)
 * @method static PostContent|Proxy     findOrCreate(array $attributes)
 * @method static PostContent|Proxy     first(string $sortedField = 'id')
 * @method static PostContent|Proxy     last(string $sortedField = 'id')
 * @method static PostContent|Proxy     random(array $attributes = [])
 * @method static PostContent|Proxy     randomOrCreate(array $attributes = [])
 * @method static PostContent[]|Proxy[] all()
 * @method static PostContent[]|Proxy[] findBy(array $attributes)
 * @method static PostContent[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static PostContent[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method        PostContent|Proxy     create(array|callable $attributes = [])
 */
final class PostContentFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'value' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(PostContent $postContent): void {})
        ;
    }

    protected static function getClass(): string
    {
        return PostContent::class;
    }
}
