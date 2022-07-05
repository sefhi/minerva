<?php

namespace Atenea\Tests\Shared\Domain\ValueObject;

use Atenea\Tests\Shared\Domain\MotherCreator;
use InvalidArgumentException;
use Atenea\Shared\Domain\ValueObject\Username;
use PHPUnit\Framework\TestCase;

class UsernameTest extends TestCase
{
    /**
     * @test
     * @dataProvider providersUsernameValid
     */
    public function itShouldCreateUsername(string $value): void
    {
        $username = new Username($value);
        self::assertEquals($value, $username->value());
    }

    /**
     * @test
     * @dataProvider providersUsernamesLengthInvalid
     */
    public function itShouldThrowAnExceptionWhenUsernameIsNotValidLength(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage(
            sprintf('%s must have a length between %s and %s character.', Username::class, 2, 70)
        );

        new Username($value);
    }

    /** @phpstan-ignore-next-line */
    public function providersUsernameValid(): array
    {
        return [
            [MotherCreator::random()->userName()],
            [MotherCreator::random()->userName()],
            [MotherCreator::random()->userName()],
            [MotherCreator::random()->userName()],
            [MotherCreator::random()->userName()],
            ['sefhirot69'],
            ['xxXCani69Xxx'],
            ['el_aniquilador88'],
        ];
    }

    /** @phpstan-ignore-next-line */
    public function providersUsernamesLengthInvalid(): array
    {
        return [
            ['xxXxxXxxXxxXxxXxxXxxXxxXxxXxxXToLargo69XxxXxxXxxXxxXxxXxxXxxXxxXxxXxxXxxXxxXxx'],
            ['x'],
        ];
    }
}
