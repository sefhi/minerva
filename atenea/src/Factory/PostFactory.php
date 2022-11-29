<?php

namespace App\Factory;

use Atenea\Posts\Domain\Post;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Post>
 *
 * @method static Post|Proxy     createOne(array $attributes = [])
 * @method static Post[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Post|Proxy     find(object|array|mixed $criteria)
 * @method static Post|Proxy     findOrCreate(array $attributes)
 * @method static Post|Proxy     first(string $sortedField = 'id')
 * @method static Post|Proxy     last(string $sortedField = 'id')
 * @method static Post|Proxy     random(array $attributes = [])
 * @method static Post|Proxy     randomOrCreate(array $attributes = [])
 * @method static Post[]|Proxy[] all()
 * @method static Post[]|Proxy[] findBy(array $attributes)
 * @method static Post[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Post[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method        Post|Proxy     create(array|callable $attributes = [])
 */
final class PostFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'id' => PostIdFactory::createOne(),
            'title' => PostTitleFactory::createOne(),
            'content' => PostContentFactory::createOne(),
            'author' => AuthorFactory::createOne(),
        ];
    }

    protected function initialize(): self
    {
        return $this->instantiateWith(static function (array $attr) {
            return Post::create(
                $attr['id'],
                $attr['title'],
                $attr['content'],
                $attr['author']
            );
        });
    }

    protected static function getClass(): string
    {
        return Post::class;
    }
}
