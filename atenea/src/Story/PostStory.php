<?php

namespace App\Story;

use App\Factory\AuthorFactory;
use App\Factory\PostFactory;
use Zenstruck\Foundry\Story;

final class PostStory extends Story
{
    public function build(): void
    {
        AuthorFactory::createMany(20);

        PostFactory::createMany(100);

        $author = AuthorFactory::createOne();

        PostFactory::createMany(
            5,
            ['author' => $author]
        );
    }
}
