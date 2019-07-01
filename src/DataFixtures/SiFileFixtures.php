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
                    ->setMediaFileName('banosCover.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($banosCover);
        $this->addReference('banosCover', $banosCover);

        $banosPicture1 = new SiFile;
        $banosPicture1 ->setName('banosPicture1')
                    ->setType(Sifile::FILE_TYPE['contentPicture'])
                    ->setMediaFileName('banosPicture1.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($banosPicture1);
        $this->addReference('banosPicture1', $banosPicture1);

        $banosPicture2 = new SiFile;
        $banosPicture2 ->setName('banosPicture2')
                    ->setType(Sifile::FILE_TYPE['contentPicture'])
                    ->setMediaFileName('banosPicture2.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($banosPicture2);
        $this->addReference('banosPicture2', $banosPicture2);

        $banosPicture3 = new SiFile;
        $banosPicture3 ->setName('banosPicture3')
                    ->setType(Sifile::FILE_TYPE['contentPicture'])
                    ->setMediaFileName('banosPicture3.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($banosPicture3);
        $this->addReference('banosPicture3', $banosPicture3);

        $banosThumbnail = new SiFile;
        $banosThumbnail ->setName('banosThumbnail')
                    ->setType(Sifile::FILE_TYPE['thumbnail'])
                    ->setMediaFileName('banosThumbnail.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($banosThumbnail);
        $this->addReference('banosThumbnail', $banosThumbnail);

        $logo1 = new SiFile;
        $logo1 ->setName('croixRousse')
                    ->setType(Sifile::FILE_TYPE['logo'])
                    ->setMediaFileName('croixRousse.png')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($logo1);
        $this->addReference('croixRousse', $logo1);

        $logo2 = new SiFile;
        $logo2 ->setName('onda')
                    ->setType(Sifile::FILE_TYPE['logo'])
                    ->setMediaFileName('onda.png')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($logo2);
        $this->addReference('onda', $logo2);

        $manager->flush();
    }
}
