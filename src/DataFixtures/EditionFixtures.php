<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Edition;

class EditionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $edition = new Edition();
        $edition->setName('2019')
            ->setdateDebut(new \DateTime('16 Oct 2019'))
            ->setdateFin(new \DateTime('27 Oct 2019'))
            ->setEditionPicture($this->getReference('edition2019Thumbnail'))
            ->setStatus("en ligne");
        $manager->persist($edition);
        $this->addReference('edition', $edition);

        // une 2eme edition  pour tester liste choix dans formulaire show
        $edition = new Edition();
        $edition->setName('2017')
            ->setdateDebut(new \DateTime('18 Sep 2017'))
            ->setdateFin(new \DateTime('29 Sep 2017'))
            ->setEditionPicture($this->getReference('edition2017Thumbnail'))
            ->setStatus("archive");
        $manager->persist($edition);

        // une 3eme edition  pour tester les archives
        $edition = new Edition();
        $edition->setName('2015')
            ->setdateDebut(new \DateTime('18 Sep 2015'))
            ->setdateFin(new \DateTime('29 Sep 2015'))
            ->setEditionPicture($this->getReference('edition2015Thumbnail'))
            ->setStatus("archive");
        $manager->persist($edition);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [

        SiFileFixtures::class
        ];
    }
}
