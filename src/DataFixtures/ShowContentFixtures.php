<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Content;
use Faker;

class ShowContentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 15; $i++) {
            $show = new Content();
            $show->setTitleFr($faker->words($nb = 3, $asText = true));
            $show->setEdition($this->getReference('edition'));
            $show->setContentType(Content::CONTENT_TYPE['show']);
            $show->setComplete(false);
            if (rand(0, 1)) { // in order to have some incomplete shows
                $show->setContentFr($faker->paragraphs($nb = 3, $asText = true));
                $show->setCountryFr($faker->country);
                $show->setPicture($this->getReference('picture_'.rand(0, 9)));
                $show->setComplete(true);
            }
            for ($j=0; $j < rand(0, 2); $j++) {
                $show->addLogo($this->getReference('logo_'.rand(0, 9)));
            }
            $show->setTranslated(false);
            if (rand(0, 1)) { // in order to have only some translated shows
                $show->setContentEn($faker->paragraphs($nb = 3, $asText = true));
                $show->setTitleEN($faker->words($nb = 3, $asText = true));
                $show->setCountryEn($faker->country);
                $show->setTranslated(true);
            }
            $manager->persist($show);
            $this->addReference('show_'.$i, $show);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [

            SiFileFixtures::class,
            EditionFixtures::class
        ];
    }
}
