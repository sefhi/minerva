<?php

namespace App\DataFixtures;

use App\Factory\TokenFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        TokenFactory::createOne();

        $manager->flush();
    }
}
