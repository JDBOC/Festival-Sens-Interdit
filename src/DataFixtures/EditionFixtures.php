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
        $edition->setName('2019')
            ->setdateDebut(new \DateTime('16 Oct 2019'))
            ->setdateFin(new \DateTime('27 Oct 2019'));
        $manager->persist($edition);
        $this->addReference('edition', $edition);

        // une 2eme edition  pour tester liste choix dans formulaire show
        $edition = new Edition();
        $edition->setName('2017')
            ->setdateDebut(new \DateTime('18 Sep 2017'))
            ->setdateFin(new \DateTime('29 Sep 2017'));
        $manager->persist($edition);
            $manager->flush();
    }
}
