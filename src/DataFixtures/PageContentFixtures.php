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
        $content->setContentFr("lorem ipsum");
        
        $manager->persist($content);
        $manager->flush();
    }
}
