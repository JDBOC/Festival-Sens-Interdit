<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\SiFile;
use App\Entity\Partner;

class SiFileFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $blackCarouselPicture = new SiFile;
        $blackCarouselPicture ->setName('blackCarouselPicture')
                    ->setType(Sifile::FILE_TYPE['carouselPicture'])
                    ->setMediaFileName('blackCarouselPicture.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($blackCarouselPicture);
         $this->addReference('blackCarouselPicture', $blackCarouselPicture);

        $redCarouselPicture = new SiFile;
        $redCarouselPicture ->setName('redCarouselPicture')
                    ->setType(Sifile::FILE_TYPE['carouselPicture'])
                    ->setMediaFileName('redCarousel.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($redCarouselPicture);
         $this->addReference('redCarouselPicture', $redCarouselPicture);

        $cycleMexique = new SiFile;
        $cycleMexique ->setName('cycleMexique')
                    ->setType(Sifile::FILE_TYPE['logo'])
                    ->setMediaFileName('cycle mexique.png')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($cycleMexique);
         $this->addReference('logoMexique', $cycleMexique);

        $blackCover = new SiFile;
        $blackCover ->setName('blackCover')
                    ->setType(Sifile::FILE_TYPE['cover'])
                    ->setMediaFileName('blackCover.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($blackCover);
        $this->addReference('blackCover', $blackCover);
        $blackCover2 = new SiFile;
        $blackCover2 ->setName('blackCover')
                    ->setType(Sifile::FILE_TYPE['cover'])
                    ->setMediaFileName('blackCover.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($blackCover2);
        $this->addReference('blackCover2', $blackCover2);

        $banosCover = new SiFile;
        $banosCover     ->setName('banosCover')
                        ->setType(Sifile::FILE_TYPE['cover'])
                        ->setMediaFileName('banosCover.jpg')
                        ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($banosCover);
        $this->addReference('banosCover', $banosCover);

        $banosPicture1 = new SiFile;
        $banosPicture1  ->setName('banosPicture1')
                        ->setType(Sifile::FILE_TYPE['contentPicture'])
                        ->setMediaFileName('banosPicture1.jpg')
                        ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($banosPicture1);
        $this->addReference('banosPicture1', $banosPicture1);

        $banosPicture2 = new SiFile;
        $banosPicture2  ->setName('banosPicture2')
                        ->setType(Sifile::FILE_TYPE['contentPicture'])
                        ->setMediaFileName('banosPicture2.jpg')
                        ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($banosPicture2);
        $this->addReference('banosPicture2', $banosPicture2);

        $banosPicture3 = new SiFile;
        $banosPicture3  ->setName('banosPicture3')
                        ->setType(Sifile::FILE_TYPE['contentPicture'])
                        ->setMediaFileName('banosPicture3.jpg')
                        ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($banosPicture3);
        $this->addReference('banosPicture3', $banosPicture3);

        $nordEstPicture2 = new SiFile;
        $nordEstPicture2 ->setName('nordEstPicture2')
                    ->setType(Sifile::FILE_TYPE['contentPicture'])
                    ->setMediaFileName('nordEstPicture2.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($nordEstPicture2);
        $this->addReference('nordEstPicture2', $nordEstPicture2);

        $nordEstPicture3 = new SiFile;
        $nordEstPicture3 ->setName('nordEstPicture3')
                    ->setType(Sifile::FILE_TYPE['contentPicture'])
                    ->setMediaFileName('nordEstPicture3.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($nordEstPicture3);
        $this->addReference('nordEstPicture3', $nordEstPicture3);

        $nordEstPicture1 = new SiFile;
        $nordEstPicture1 ->setName('nordEstPicture1')
                    ->setType(Sifile::FILE_TYPE['contentPicture'])
                    ->setMediaFileName('nordEstPicture1.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($nordEstPicture1);
        $this->addReference('nordEstPicture1', $nordEstPicture1);

        $banosThumbnail = new SiFile;
        $banosThumbnail ->setName('banosThumbnail')
                    ->setType(Sifile::FILE_TYPE['thumbnail'])
                    ->setMediaFileName('banosThumbnail.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($banosThumbnail);
        $this->addReference('banosThumbnail', $banosThumbnail);

        $antartiqueThumbnail = new SiFile;
        $antartiqueThumbnail ->setName('antartiqueThumbnail')
                    ->setType(Sifile::FILE_TYPE['thumbnail'])
                    ->setMediaFileName('antartiqueThumbnail.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($antartiqueThumbnail);
        $this->addReference('antartiqueThumbnail', $antartiqueThumbnail);

        $constitutionThumbnail = new SiFile;
        $constitutionThumbnail ->setName('constitutionThumbnail')
                    ->setType(Sifile::FILE_TYPE['thumbnail'])
                    ->setMediaFileName('constitutionThumbnail.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($constitutionThumbnail);
        $this->addReference('constitutionThumbnail', $constitutionThumbnail);

        $girlsCashThumbnail = new SiFile;
        $girlsCashThumbnail ->setName('girlsCashThumbnail')
                    ->setType(Sifile::FILE_TYPE['thumbnail'])
                    ->setMediaFileName('girlsCashThumbnail.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($girlsCashThumbnail);
        $this->addReference('girlsCashThumbnail', $girlsCashThumbnail);

        $tijuanaThumbnail = new SiFile;
        $tijuanaThumbnail ->setName('tijuanaThumbnail')
                    ->setType(Sifile::FILE_TYPE['thumbnail'])
                    ->setMediaFileName('tijuanaThumbnail.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($tijuanaThumbnail);
        $this->addReference('tijuanaThumbnail', $tijuanaThumbnail);

        $exilConflitsThumbnail = new SiFile;
        $exilConflitsThumbnail ->setName('exilConflitsThumbnail')
                    ->setType(Sifile::FILE_TYPE['thumbnail'])
                    ->setMediaFileName('exilConflitsThumbnail.png')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($exilConflitsThumbnail);
        $this->addReference('exilConflitsThumbnail', $exilConflitsThumbnail);

        $nordEstThumbnail = new SiFile;
        $nordEstThumbnail ->setName('nordEstThumbnail')
                    ->setType(Sifile::FILE_TYPE['thumbnail'])
                    ->setMediaFileName('nordEstThumbnail.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($nordEstThumbnail);
        $this->addReference('nordEstThumbnail', $nordEstThumbnail);

        $edition2019Thumbnail = new SiFile;
        $edition2019Thumbnail ->setName('edition2019Thumbnail')
                    ->setType(Sifile::FILE_TYPE['thumbnail'])
                    ->setMediaFileName('edition2019.png')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($edition2019Thumbnail);
        $this->addReference('edition2019Thumbnail', $edition2019Thumbnail);

        $edition2017Thumbnail = new SiFile;
        $edition2017Thumbnail ->setName('edition2017Thumbnail')
                    ->setType(Sifile::FILE_TYPE['thumbnail'])
                    ->setMediaFileName('edition2017.jpg')
                    ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($edition2017Thumbnail);
        $this->addReference('edition2017Thumbnail', $edition2017Thumbnail);

        $edition2015Thumbnail = new SiFile;
        $edition2015Thumbnail ->setName('edition2015Thumbnail')
            ->setType(Sifile::FILE_TYPE['thumbnail'])
            ->setMediaFileName('edition2015.jpg')
            ->setUpdatedAt(new \DateTime('now'));
        $manager->persist($edition2015Thumbnail);
        $this->addReference('edition2015Thumbnail', $edition2015Thumbnail);

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
