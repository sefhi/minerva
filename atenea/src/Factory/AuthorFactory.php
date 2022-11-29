<?php

namespace App\Factory;

use Atenea\Authors\Domain\Author;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Author>
 *
 * @method static Author|Proxy     createOne(array $attributes = [])
 * @method static Author[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Author|Proxy     find(object|array|mixed $criteria)
 * @method static Author|Proxy     findOrCreate(array $attributes)
 * @method static Author|Proxy     first(string $sortedField = 'id')
 * @method static Author|Proxy     last(string $sortedField = 'id')
 * @method static Author|Proxy     random(array $attributes = [])
 * @method static Author|Proxy     randomOrCreate(array $attributes = [])
 * @method static Author[]|Proxy[] all()
 * @method static Author[]|Proxy[] findBy(array $attributes)
 * @method static Author[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Author[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method        Author|Proxy     create(array|callable $attributes = [])
 */
final class AuthorFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'id' => AuthorIdFactory::createOne(),
            'name' => NameFactory::createOne(),
            'username' => UsernameFactory::createOne(),
            'website' => WebsiteFactory::createOne(),
            'email' => EmailFactory::createOne(),
        ];
    }

    protected function initialize(): self
    {
        return $this->instantiateWith(static function (array $attr) {
            return Author::create(
                $attr['id'],
                $attr['name'],
                $attr['username'],
                $attr['website'],
                $attr['email'],
            );
        });
    }

    protected static function getClass(): string
    {
        return Author::class;
    }
}
