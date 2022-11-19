<?php

namespace Atenea\Tests\Shared\Domain\ValueObject;

use Atenea\Tests\Shared\Domain\MotherCreator;
use Atenea\Shared\Domain\ValueObject\Website;
use PHPUnit\Framework\TestCase;

class WebsiteTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider providersWebSiteValid
     */
    public function itShouldCreateWebSite(string $value): void
    {
        $website = new Website($value);
        self::assertEquals($value, $website->value());
    }

    /** @phpstan-ignore-next-line */
    public function providersWebSiteValid(): array
    {
        return [
           [MotherCreator::random()->url()],
           [MotherCreator::random()->url()],
           [MotherCreator::random()->url()],
           [MotherCreator::random()->url()],
           [MotherCreator::random()->url()],
        ];
    }
}
