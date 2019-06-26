<?php

namespace App\DataFixtures;

use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Content;

class ShowContentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        
        $show = new Content;
        $show   ->setTitleFr('Banos Rama')
                ->setEdition($this->getReference('edition'))
                ->setCountryFr('France')
                ->setShowType(1)
                ->setContentFr('
    <div>
        <p><strong>De :</strong> Eduardo Bernal, Jorge A. Vargas, Gabriel Contreras</p>
        <p><strong>Mise en sc&egrave;ne :</strong> Jorge A. Vargas &nbsp;</p>
        <p><strong>pays :</strong> Mexique</p>
    </div>
    <h2>Pr&eacute;sentation</h2>
    <p>1&Egrave;RE EN FRANCE Pr&eacute;sentation &laquo; Nous cherchons &agrave; restituer l&rsquo;incertitude avec 
    laquelle on tente d&rsquo;exprimer ce qui fait qu&rsquo;un souvenir se r&eacute;fugie dans la m&eacute;moire.
     &raquo; (Jorge A. Vargas). C&rsquo;est autour de la figure populaire mexicaine qu&rsquo;est le champion du monde
      de boxe Jos&eacute; Angel Napoles dit &laquo;Mantequilla&raquo; que s&rsquo;organise Ba&ntilde;os Roma.</p>
    <h2>L&rsquo;&eacute;quipe:</h2>
    <p>Avec: blsqfkjsqmlfhsqlkhfq</p>
    <p>Musique: fdsmlkjglkdshglkjds</p>
                    ')
                ->setContentType(Content::CONTENT_TYPE['show'])
                ->setComplete(true)
                ->setTranslated(true)
                ->setCover($this->getReference('banosCover'))
                ->addPicture($this->getReference('banosPicture1'))
                ->addPicture($this->getReference('banosPicture2'))
                ->addPicture($this->getReference('banosPicture3'))
                ->setThumbnail($this->getReference('banosThumbnail'))
                ;
        $this->addReference('showBanos', $show);
        $manager->persist($show);


        $faker = Faker\Factory::create();
        for ($i=0; $i <10; $i++) { // for each created show
            for ($j=0; $j < rand(0, 3); $j++) { // generate 0 to 3 session for each show
                $content = new Content();
                $content
                    ->setTitleFr($faker->word)
                    ->setEdition($this->getReference('edition'))
                    ->setCountryFr($faker->word)
                    ->setShowType(1)
                    ->setContentFr($faker->text($maxNbChars = 200))
                    ->setContentType(Content::CONTENT_TYPE['show'])
                    ->setComplete(false)
                    ->setTranslated(false)
                    ->setCover($this->getReference('banosCover'))
                    ->addPicture($this->getReference('banosPicture2'))
                    ->addPicture($this->getReference('banosPicture3'))
                    ->setThumbnail($this->getReference('banosThumbnail'));

                $manager->persist($content);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [

            SiFileFixtures::class,
            EditionFixtures::class
        ];
    }
}
