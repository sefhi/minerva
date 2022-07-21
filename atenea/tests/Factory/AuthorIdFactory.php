<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use Atenea\Shared\Domain\ValueObject\AuthorId;
use Zenstruck\Foundry\ModelFactory;

final class AuthorIdFactory extends ModelFactory
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
            'value' => self::faker()->randomNumber(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Author $author): void {})
            ;
    }

    protected static function getClass(): string
    {
        return AuthorId::class;
    }
}
