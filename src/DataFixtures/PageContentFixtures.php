<?php

namespace App\DataFixtures;

//use Entité à manipuler
use App\Entity\Content;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PageContentFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $content = new Content();
        $content->setTitleFr("test");
        $content->setContentFr("lorem ipsum")
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(true);
        
        $manager->persist($content);
        $manager->flush();
    }
}
