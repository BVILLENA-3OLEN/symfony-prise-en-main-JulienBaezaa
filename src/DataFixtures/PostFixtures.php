<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Post;
use Doctrine\DBAL\Types\TimeImmutableType;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create(locale:'fr_FR');
        
        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post
                ->setTitle($faker->realTextBetween(10, 50)) // Title between 10 and 50 characters
                ->setAuthor($faker->name())
                ->setContent($faker->realText()) 
                ->setPublishedAt(\DateTimeImmutable::createFromMutable(
                    $faker->dateTimeBetween('-20 days', '+5 days')// Published date between -20 days and +5 days;
                    ) 
                );
                $manager->persist($post);
        }

        $manager->flush();
    }
}
