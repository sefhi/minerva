<?php

namespace Atenea\Tests\Posts\Domain;

use Atenea\Tests\Shared\Domain\MotherCreator;
use InvalidArgumentException;
use Atenea\Posts\Domain\PostContent;
use PHPUnit\Framework\TestCase;

class PostContentTest extends TestCase
{
    /**
     * @test
     * @dataProvider providersContentValid
     */
    public function itShouldCreateTitle(string $value): void
    {
        $content = new PostContent($value);
        self::assertEquals($value, $content->value());
    }

    /**
     * @test
     * @dataProvider providersContentLengthInvalid
     */
    public function itShouldThrowAnExceptionWhenTitleHaveInvalidLength(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage(
            sprintf('%s must have a length between %s and %s character.', PostContent::class, 5, 10000)
        );

        new PostContent($value);
    }

    /** @phpstan-ignore-next-line */
    public function providersContentValid(): array
    {
        return [
            [MotherCreator::random()->realText(50)],
            [MotherCreator::random()->realText(50)],
            [MotherCreator::random()->realText(100)],
            [MotherCreator::random()->realText(5000)],
            [MotherCreator::random()->text(6000)],
        ];
    }

    /** @phpstan-ignore-next-line */
    public function providersContentLengthInvalid(): array
    {
        return [
            ['hi'],
            ['h'],
        ];
    }
}
