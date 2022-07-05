<?php

namespace Atenea\Tests\Posts\Domain;

use Atenea\Tests\Shared\Domain\MotherCreator;
use InvalidArgumentException;
use Atenea\Posts\Domain\PostTitle;
use PHPUnit\Framework\TestCase;

class PostTitleTest extends TestCase
{
    /**
     * @test
     * @dataProvider providersTitleValid
     */
    public function itShouldCreateTitle(string $value): void
    {
        $title = new PostTitle($value);
        self::assertEquals($value, $title->value());
    }

    /**
     * @test
     * @dataProvider providersTitleLengthInvalid
     */
    public function itShouldThrowAnExceptionWhenTitleHaveInvalidLength(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage(
            sprintf('%s must have a length between %s and %s character.', PostTitle::class, 5, 100)
        );

        new PostTitle($value);
    }

    /** @phpstan-ignore-next-line */
    public function providersTitleValid(): array
    {
        return [
            [MotherCreator::random()->realText(50)],
            [MotherCreator::random()->realText(50)],
            [MotherCreator::random()->realText(50)],
            [MotherCreator::random()->realText(50)],
            [MotherCreator::random()->realText(50)],
        ];
    }

    /** @phpstan-ignore-next-line */
    public function providersTitleLengthInvalid(): array
    {
        return [
            [MotherCreator::random()->realTextBetween(101)],
            [MotherCreator::random()->realTextBetween(100)],
            ['hi'],
            ['h'],
        ];
    }
}
