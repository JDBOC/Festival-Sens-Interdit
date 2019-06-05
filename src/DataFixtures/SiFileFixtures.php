<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\SiFile;
use \Faker;

class SiFileFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
            $faker = Faker\Factory::create();

            //picture fixture
        for ($i=0; $i < 10; $i++) {
            $picture = new SiFile();
            $picture->setName($faker->word);
            $picture->setMimeType('image/jpeg');
            $picture->setLink($faker->imageUrl($width = 640, $height = 480));
            $picture->setType(SiFile::FILE_TYPE['picture']);
            $manager->persist($picture);
            $this->addReference('picture_'.$i, $picture);
        }

            //logo fixture
        for ($i=0; $i < 10; $i++) {
            $logo = new SiFile();
            $logo->setName($faker->word);
            $logo->setMimeType('image/jpeg');
            $logo->setLink($faker->imageUrl($width = 100, $height = 100));
            $logo->setType(SiFile::FILE_TYPE['logo']);
            $manager->persist($logo);
            $this->addReference('logo_'.$i, $logo);
        }


        $manager->flush();
    }
}
