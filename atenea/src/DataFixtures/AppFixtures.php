<?php

namespace App\DataFixtures;

use App\Factory\AuthorFactory;
use App\Factory\PostFactory;
use App\Story\PostStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        PostStory::load();

        $manager->flush();
    }
}
