<?php

namespace Minerva\Tests\Shared\Domain\ValueObject;

use Minerva\Tests\Shared\Domain\MotherCreator;
use Minerva\Shared\Domain\ValueObject\Website;
use PHPUnit\Framework\TestCase;

class WebsiteTest extends TestCase
{
    /**
     * @test
     * @dataProvider providersWebSiteValid
     */
    public function itShouldCreateWebSite(string $value): void
    {
        $website = new Website($value);
        self::assertEquals($value, $website->value());
    }

    /**
     * @return array<int, array<int, string>>
     */
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