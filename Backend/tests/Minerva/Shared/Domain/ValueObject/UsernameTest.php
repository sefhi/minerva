<?php

namespace Minerva\Tests\Shared\Domain\ValueObject;

use App\Tests\Minerva\Shared\Domain\MotherCreator;
use Couchbase\User;
use InvalidArgumentException;
use Minerva\Shared\Domain\ValueObject\Username;
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
            sprintf('%s must have a length between %s and %s character.', Username::class, 5, 50)
        );

        new Username($value);
    }

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

    public function providersUsernamesLengthInvalid()
    {
        return [
            ['xxXxxXxxXxxXxxXxxXxxXxxXxxXxxXToLargo69XxxXxxXxxXxxXxxXxxXxxXxxXxxXxxXxxXxxXxx'],
            ['x'],
            ['xy'],
        ];
    }


}
