<?php

namespace Atenea\Tests\Shared\Domain\ValueObject;

use Atenea\Tests\Shared\Domain\MotherCreator;
use InvalidArgumentException;
use Atenea\Shared\Domain\ValueObject\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /**
     * @test
     * @dataProvider providersEmailValid
     */
    public function itShouldCreateEmail(string $value): void
    {
        $email = new Email($value);
        self::assertEquals($value, $email->value());
    }

    /**
     * @test
     * @dataProvider providersEmailInvalid
     */
    public function itShouldThrowAnExceptionWhenEmailIsNotValid(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage(sprintf('Email %s is not valid in %s', $value, Email::class));

        new Email($value);
    }

    /** @phpstan-ignore-next-line */
    public function providersEmailValid(): array
    {
        return [
            [MotherCreator::random()->email()],
            [MotherCreator::random()->email()],
            [MotherCreator::random()->companyEmail()],
            [MotherCreator::random()->companyEmail()],
            [MotherCreator::random()->companyEmail()],
            [MotherCreator::random()->freeEmail()],
        ];
    }

    /** @phpstan-ignore-next-line */
    public function providersEmailInvalid(): array
    {
        return [
            ['hi'],
            ['hi.es'],
            [MotherCreator::random()->word()],
            [MotherCreator::random()->text(40)],
            [MotherCreator::random()->domainWord()],
            [MotherCreator::random()->domainName()],
            ['peito@gmail'],
        ];
    }
}
