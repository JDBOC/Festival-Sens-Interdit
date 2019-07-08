<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Theme;

class ThemeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $theme = new Theme();
        $theme->setName('cycle Mexique')
                ->setpicture($this->getReference('logoMexique'))
        ;
        $manager->persist($theme);
        $this->addReference('themeMexique', $theme);

            $manager->flush();
    }

    public function getDependencies()
    {
        return [

        SiFileFixtures::class
        ];
    }
}
