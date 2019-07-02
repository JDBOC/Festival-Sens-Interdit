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
                ->addTarif($this->getReference('tarif2'));
        $manager->persist($session);

        $session2 = new Session();
        $session2->setSessionDate(new \DateTime('19 Oct 2019 16:00'))
            ->setLocation('Théâtre de la Croix Rousse')
            ->setMapadoLink('https://sensinterdits.mapado.com/event/lyon/banos-roma')
            ->setContent($this->getReference('showBanos'))
            ->addTarif($this->getReference('tarif1'))
            ->addTarif($this->getReference('tarif2'));
        $manager->persist($session2);

        $session3 = new Session();
        $session3->setSessionDate(new \DateTime('16 Oct 2019 20:00'))
            ->setLocation('Théâtre des Celestins')
            ->setMapadoLink('https://sensinterdits.mapado.com/event/lyon/banos-roma')
            ->setContent($this->getReference('showAntartique'))
            ->addTarif($this->getReference('tarif1'))
            ->addTarif($this->getReference('tarif2'));
        $manager->persist($session3);

        $session4 = new Session();
        $session4->setSessionDate(new \DateTime('17 Oct 2019 21:00'))
            ->setLocation('Théâtre des Celestins')
            ->setMapadoLink('https://sensinterdits.mapado.com/event/lyon/banos-roma')
            ->setContent($this->getReference('showAntartique'))
            ->addTarif($this->getReference('tarif1'))
            ->addTarif($this->getReference('tarif2'));
        $manager->persist($session4);

        $session5 = new Session();
        $session5->setSessionDate(new \DateTime('17 Oct 2019 19:00'))
            ->setLocation('Théâtre nouvelle génération')
            ->setMapadoLink('https://sensinterdits.mapado.com/event/lyon/banos-roma')
            ->setContent($this->getReference('showTijuana'))
            ->addTarif($this->getReference('tarif1'))
            ->addTarif($this->getReference('tarif2'));
        $manager->persist($session5);

        $session6 = new Session();
        $session6->setSessionDate(new \DateTime('17 Oct 2019 19:00'))
            ->setLocation('Les subsistances')
            ->setMapadoLink('https://sensinterdits.mapado.com/event/lyon/banos-roma')
            ->setContent($this->getReference('showGirlsCash'))
            ->addTarif($this->getReference('tarif1'))
            ->addTarif($this->getReference('tarif2'));
        $manager->persist($session6);

        $session7 = new Session();
        $session7->setSessionDate(new \DateTime('17 Oct 2019 20:30'))
            ->setLocation('Toboggan')
            ->setMapadoLink('https://sensinterdits.mapado.com/event/lyon/banos-roma')
            ->setContent($this->getReference('showConstitution'))
            ->addTarif($this->getReference('tarif1'))
            ->addTarif($this->getReference('tarif2'));
        $manager->persist($session7);

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
