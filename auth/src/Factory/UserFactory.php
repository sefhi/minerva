<?php

namespace App\Factory;

use Auth\Domain\User\PasswordHasher;
use Auth\Domain\User\User;
use Ramsey\Uuid\Uuid;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<User>
 *
 * @method static User|Proxy     createOne(array $attributes = [])
 * @method static User[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static User[]|Proxy[] createSequence(array|callable $sequence)
 * @method static User|Proxy     find(object|array|mixed $criteria)
 * @method static User|Proxy     findOrCreate(array $attributes)
 * @method static User|Proxy     first(string $sortedField = 'id')
 * @method static User|Proxy     last(string $sortedField = 'id')
 * @method static User|Proxy     random(array $attributes = [])
 * @method static User|Proxy     randomOrCreate(array $attributes = [])
 * @method static User[]|Proxy[] all()
 * @method static User[]|Proxy[] findBy(array $attributes)
 * @method static User[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static User[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method        User|Proxy     create(array|callable $attributes = [])
 */
final class UserFactory extends ModelFactory
{
    public function __construct(private readonly PasswordHasher $passwordHasher)
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'id' => Uuid::uuid4(),
            'roles' => [],
            'active' => true,
            'email' => EmailFactory::createOne(),
            'password' => PasswordFactory::createOne(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this->afterInstantiate(function (User $user): void {
            $user->withPasswordEncrypted($this->passwordHasher->hash($user->getPassword()));
        })
        ;
    }

    protected static function getClass(): string
    {
        return User::class;
    }
}
