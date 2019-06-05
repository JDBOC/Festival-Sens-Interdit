<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Session;
use Faker;

class SessionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i <15; $i++) { // for each created show
            for ($j=0; $j < rand(0, 3); $j++) { // generate 0 to 3 session for each show
                $session = new Session();
                $session->setSessionDate($faker->dateTimeThisYear($max = 'now', $timezone = 'Europe/Paris'));
                $session->setLocation($faker->streetName);
                $session->setContent($this->getReference('content_'.$i));
                $manager->persist($session);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ShowContentFixtures::class
        ];
    }
}
