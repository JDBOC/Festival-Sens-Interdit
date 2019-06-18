<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\SiFile;

class SiFileFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $banosCover = new SiFile;
        $banosCover ->setName('banosCover')
                                ->setType(Sifile::FILE_TYPE['cover'])
                                ->setMediaFileName('banosCover.jpg');
        $manager->flush();
    }
}
