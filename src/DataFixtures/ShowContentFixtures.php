<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Content;

class ShowContentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        
        $show = new Content;
        $show   ->setTitleFr('Banos Rama')
                ->setContentType(Content::CONTENT_TYPE['show'])
                ->setComplete(true)
                ->setTranslated(true);
        $this->addReference('showBamos', $show);
        $manager->persist($show);
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
