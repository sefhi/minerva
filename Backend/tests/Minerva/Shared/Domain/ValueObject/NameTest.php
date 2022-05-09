<?php

namespace Minerva\Tests\Shared\Domain\ValueObject;

use App\Tests\Minerva\Shared\Domain\MotherCreator;
use InvalidArgumentException;
use Minerva\Shared\Domain\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    /**
     * @test
     * @dataProvider providerNamesValid
     */
    public function itShouldCreateName(string $value): void
    {
        $name = new Name($value);
        self::assertEquals($value, $name->value());
    }

    /**
     * @test
     * @dataProvider providerNamesLengthInvalid
     */
    public function itShouldThrowAndExceptionWhenNameLengthIsNotValid(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage(Name::class.' must have a length between 3 and 50 character.');

        new Name($value);
    }

    /**
     * @test
     * @dataProvider providerNamesInValid
     */
    public function itShouldThrowAndExceptionWhenNameIsNotValid(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage($value.' is not valid in '.Name::class);

        new Name($value);
    }

    private function providerNamesLengthInvalid(): array
    {
        return [
            ['hi'],
            ['hihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihihi'],
            ['h'],
        ];
    }

    private function providerNamesValid(): array
    {
        return [
            ['Pepe Huevo Frito'],
            ['Dolores del Ano'],
            ['Testículo de Jehova'],
            ['Álvaro Morán'],
            ['Dr.Mongolo'],
            ['Jose María Nuñez'],
            [MotherCreator::random()->firstName().' '.MotherCreator::random()->lastName()],
            [MotherCreator::random()->firstName().' '.MotherCreator::random()->lastName()],
            [MotherCreator::random()->firstName().' '.MotherCreator::random()->lastName()],
        ];
    }

    private function providerNamesInValid(): array
    {
        return [
            ['_Pepito_'],
            ['D0l0r3s del 4n0'],
            ['T3stìculo de Jehova'],
            ['1234'],
            ['Têst näs'],
            ['xxXS3fhiXxx'],
        ];
    }
}
