<?php

namespace App\DataFixtures;

//use Entité à manipuler
use App\Entity\Tarif;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TarifsFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tarif = new Tarif();
        $tarif  ->setGrille(1)
                ->setPassFestival(17)
                ->setPassJeune(11)
                ->setPleinTarif(25)
                ->setReduce(21)
                ->setJeune(13)
                ->setRSA(9);
        $manager->persist($tarif);
        $this->addReference('tarif1', $tarif);

        $tarif2 = new Tarif();
        $tarif2  ->setGrille(2)
            ->setPassFestival(14)
            ->setPassJeune(9)
            ->setPleinTarif(20)
            ->setReduce(16)
            ->setJeune(11)
            ->setRSA(9);

        $manager->persist($tarif2);
        $this->addReference('tarif2', $tarif2);

        $manager->flush();
    }
}
