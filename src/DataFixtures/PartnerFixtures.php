<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Partner;
use App\Entity\SiFile;
use App\Form\SiFileType;
use \Faker;

/**
 * Create Fixtures of partner's logo
 */
class PartnerFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * Create a new logo
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // initialization of Faker in chosen language
        // $faker  =  Faker\Factory::create('fr_FR');

        // for ($j=1; $j < 7; $j++) {
        //     // Create 5 partners in each type
        //     for ($i=0; $i < 5; $i++) {
        //         $partner = new Partner();
        //         $partner->setName($faker->name)
        //                 ->setLink($faker->url)
        //                 ->setType($j)
        //                 ->setLogo($this->getReference('partnerLogoFixture'.($j*$i)));

        //         $manager->persist($partner);
        //     }
        // }
        // $manager->flush();
    }

    /**
     * Manages the order of application of Fixtures
     * @return array of Fixtures SiFile
     */
    public function getDependencies()
    {
        return [
            SiFileFixtures::class,
        ];
    }
}
