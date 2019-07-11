<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Content;
use App\Entity\SiFile;
use App\Service\ContentService;

class NewsFixtures extends Fixture implements DependentFixtureInterface
{

    private $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function load(ObjectManager $manager)
    {
        $carousel = new SiFile();
        $carousel->setType(SiFile::FILE_TYPE['carouselPicture']);
        $carousel->setMediaFileName("redCarousel.jpg");
        $carousel->setUpdatedAt(new \DateTime("now"));
        $cover = new SiFile();
        $cover->setType(SiFile::FILE_TYPE['cover']);
        $cover->setMediaFileName("blackcover.jpg");
        $cover->setUpdatedAt(new \DateTime("now"));
        $thumbnail = new SiFile();
        $thumbnail->setType(SiFile::FILE_TYPE['thumbnail']);
        $thumbnail->setMediaFileName("blackThumbnail.jpg");
        $thumbnail->setUpdatedAt(new \DateTime("now"));
        $redNews = new Content;
        $redNews   ->setTitleFr('Ma news sur fond rouge')
                ->setSlug($this->contentService->slugAndCheck($redNews->getTitleFr()))
                ->setContentFr('<p>Loving him is like driving a new Maserati down a dead-end street,
                 Faster than the wind, passionate as sin ending so suddenly</p>
                <p>Loving him is like trying to change your mind once you&#39;re already flying through the free fall,
                 Like the colors in autumn, so bright just before they lose it all</p>')
                ->setContentType(Content::CONTENT_TYPE['actualités'])
                ->setComplete(false)
                ->setTranslated(false)
                ->setTopArticle(true)
                ->setCarouselPicture($carousel)
                ->setCover($cover)
                ->setThumbnail($thumbnail)
                ;
        $manager->persist($redNews);


        $carousel = new SiFile();
        $carousel->setType(SiFile::FILE_TYPE['carouselPicture']);
        $carousel->setMediaFileName("blackCarousel.jpg");
        $carousel->setUpdatedAt(new \DateTime("now"));
        $cover = new SiFile();
        $cover->setType(SiFile::FILE_TYPE['cover']);
        $cover->setMediaFileName("blackcover.jpg");
        $cover->setUpdatedAt(new \DateTime("now"));
        $thumbnail = new SiFile();
        $thumbnail->setType(SiFile::FILE_TYPE['thumbnail']);
        $thumbnail->setMediaFileName("blackThumbnail.jpg");
        $thumbnail->setUpdatedAt(new \DateTime("now"));
        $blackNews = new Content;
        $blackNews   ->setTitleFr('Ma news sur fond noir')
                ->setSlug($this->contentService->slugAndCheck($redNews->getTitleFr()))
                ->setContentFr('<div>Noir c&#39;est noir, Il n&#39;y a plus d&#39;espoir, Oui, gris c&#39;est gris,
                 Et c&#39;est fini, oh, oh, oh, oh<br /> &Ccedil;a me rend fou, J&#39;ai cru &agrave; ton amour,
                  Et je perds tout,Je suis dans le noir, Et j&#39;ai du mal &agrave; croire, Au gris de l&#39;ennui
                  <br />Et je te crie, oh, oh, oh, oh, Je ferai tout Pour sauver notre amour
                   Tout jusqu&#39;au bout</div>')
                ->setContentType(Content::CONTENT_TYPE['actualités'])
                ->setComplete(false)
                ->setTranslated(false)
                ->setTopArticle(true)
                ->setCarouselPicture($carousel)
                ->setCarouselPicture($carousel)
                ->setCover($cover)
                ->setThumbnail($thumbnail)
                ;
        $manager->persist($blackNews);

        

        $manager->flush();
    }

    public function getDependencies()
    {
        return [

            SiFileFixtures::class,
            EditionFixtures::class,
            ThemeFixtures::class
        ];
    }
}
