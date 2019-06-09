<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Edition;

class EditionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $edition = new Edition();
        $edition->setName('2019');
        $manager->persist($edition);
        $this->addReference('edition', $edition);
        // une 2eme edition  pour tester liste choix dans formulaire show
        $edition = new Edition();
        $edition->setName('2017');
        $manager->persist($edition);
        $manager->flush();
    }
}
