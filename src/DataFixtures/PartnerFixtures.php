<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Partner;
use App\Entity\SiFile;
use App\Form\SiFileType;
use \Faker;

class PartnerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Initialisation de faker dans la langue souhaitée
        $faker  =  Faker\Factory::create('fr_FR');

        for ($j=1; $j < 7; $j++) {
            // Création de 5 Partenaires par type de
            // partenaire
            for ($i=0; $i < 5; $i++) {
                $partner = new Partner();
                $partner->setName($faker->name);
                $partner->setLink($faker->url);
                // $partner->setLogo($SiFile->logo);
                $partner->setType($j);

                $manager->persist($partner);
            }
        }
        
        $manager->flush();
    }
}
