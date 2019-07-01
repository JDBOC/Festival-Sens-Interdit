<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Session;

class SessionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $session = new Session();
        $session->setSessionDate(new \DateTime('18 Oct 2019 19:00'))
                ->setLocation('Théâtre de la Croix Rousse')
                ->setMapadoLink('https://sensinterdits.mapado.com/event/lyon/banos-roma')
                ->setContent($this->getReference('showBanos'))
                ->addTarif($this->getReference('tarif1'))
                ->addTarif($this->getReference('tarif2'))
        ;
        $manager->persist($session);
            $session2 = new Session();
            $session2->setSessionDate(new \DateTime('19 Oct 2019 16:00'))
                ->setLocation('Théâtre de la Croix Rousse')
                ->setMapadoLink('https://sensinterdits.mapado.com/event/lyon/banos-roma')
                ->setContent($this->getReference('showBanos'))
                ->addTarif($this->getReference('tarif1'))
                ->addTarif($this->getReference('tarif2'))
        ;
        $manager->persist($session2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ShowContentFixtures::class,
            TarifsFixtures::class
        ];
    }
}
