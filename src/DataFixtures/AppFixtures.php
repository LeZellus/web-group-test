<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $article = new Article();
            $article->setTitle($faker->words(5, true));
            $article->setCover('space.jpeg');
            $article->setContent($faker->text(300));
            $manager->persist($article);
        }
        $manager->flush();
    }
}
