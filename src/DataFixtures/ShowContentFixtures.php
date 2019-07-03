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
                ->setCountryFr('Mexique')
                ->setContentFr('
    <h2 style="text-align:right"><span style="color:#ff0000; font-size:14pt">1<sup>&Egrave;RE</sup> 
    EN FRANCE</span></h2>

<h2 style="text-align:justify">Pr&eacute;sentation</h2>

<p style="text-align:justify">&laquo;&nbsp;Nous cherchons &agrave; restituer l&rsquo;incertitude avec laquelle on tente
 d&rsquo;exprimer ce qui fait qu&rsquo;un souvenir se r&eacute;fugie dans la m&eacute;moire.&nbsp;&raquo; (Jorge A. 
 Vargas).<br />
C&rsquo;est autour de la figure populaire mexicaine qu&rsquo;est le champion du monde de boxe Jos&eacute; Angel Napoles
 dit &laquo;Mantequilla&raquo; que s&rsquo;organise <em>Ba&ntilde;os Rom</em>a. R&eacute;f&eacute;rence au nom de la 
 salle de gym de Juarez dans laquelle le sportif s&rsquo;entrainait dans sa jeunesse, le spectacle esquisse le portrait
  d&rsquo;un homme aussi bien que celui d&rsquo;une ville d&eacute;truite par la violence et le trafic de drogues.
   C&rsquo;est du basculement dans le conflit dont t&eacute;moignent les cinq interpr&egrave;tes au plateau, 
   confront&eacute;s comme sur un ring &agrave; une histoire r&eacute;cente douloureuse qu&rsquo;ils doivent porter 
   ensemble jusque dans le pr&eacute;sent.</p>
                    ')
                ->setContentType(Content::CONTENT_TYPE['festival'])
                ->setComplete(false)
                ->setTranslated(false)
                ->setCover($this->getReference('banosCover'))
                ->addPicture($this->getReference('banosPicture1'))
                ->addPicture($this->getReference('banosPicture2'))
                ->addPicture($this->getReference('banosPicture3'))
                ->setThumbnail($this->getReference('banosThumbnail'))
                ->setDuree('1h15')
                ->setLieu('theatre de la croix rousse')
                ->setNote('Spectacle espagnol, surtitré en français </br>
                    Conseillé à partir de 15 ans.')
                ->setAuthor('Eduardo Bernal, Jorge A. Vargas, Gabriel Contreras')
                ->setDirector('Jorge A. Vargas')
                ->addLogo($this->getReference('croixRousse'))
                ->addLogo($this->getReference('onda'))
                ;
        $this->addReference('showBanos', $show);
        $manager->persist($show);

        $show2 = new Content;
        $show2   ->setTitleFr('Ma petite Antartique')
                ->setEdition($this->getReference('edition'))
                ->setCountryFr('Mexique')
                ->setContentType(Content::CONTENT_TYPE['festival'])
                ->setComplete(false)
                ->setTranslated(false)
                ->setThumbnail($this->getReference('antartiqueThumbnail'))
                ;
        $this->addReference('showAntartique', $show2);
        $manager->persist($show2);

        $show3 = new Content;
        $show3   ->setTitleFr('Constitution')
                ->setEdition($this->getReference('edition'))
                ->setCountryFr('Mexique')
                ->setContentType(Content::CONTENT_TYPE['festival'])
                ->setComplete(false)
                ->setTranslated(false)
                ->setThumbnail($this->getReference('constitutionThumbnail'))
                ;
        $this->addReference('showConstitution', $show3);
        $manager->persist($show3);


        $show4 = new Content;
        $show4   ->setTitleFr('Girls boys love cash')
                ->setEdition($this->getReference('edition'))
                ->setCountryFr('Mexique')
                ->setContentType(Content::CONTENT_TYPE['festival'])
                ->setComplete(false)
                ->setTranslated(false)
                ->setThumbnail($this->getReference('girlsCashThumbnail'))
                ;
        $this->addReference('showGirlsCash', $show4);
        $manager->persist($show4);


        $show5 = new Content;
        $show5   ->setTitleFr('Tijuana')
                ->setEdition($this->getReference('edition'))
                ->setCountryFr('Mexique')
                ->setContentType(Content::CONTENT_TYPE['festival'])
                ->setComplete(false)
                ->setTranslated(false)
                ->setThumbnail($this->getReference('tijuanaThumbnail'))
                ;
        $this->addReference('showTijuana', $show5);
        $manager->persist($show5);

        $horScene1 = new Content;
        $horScene1  ->setTitleFr('Rencontre avec Milo Rau')
                    ->setContentType(Content::CONTENT_TYPE['hors scène'])
                    ->setContentFr("<h2 style='text-align:justify'><span style='color:#ff0000'>RENCONTRE
                     (sous r&eacute;serve)&nbsp;</span></h2>
<p>&nbsp;</p>
<p>Le metteur en sc&egrave;ne et cin&eacute;aste suisse, aujourd&rsquo;hui&nbsp;directeur du th&eacute;&acirc;tre belge
 NT-Gent, vient nous faire part&nbsp;des questionnements qui l&rsquo;animent en tant qu&rsquo;artiste de&nbsp;th&eacute;
 &acirc;tre politique &agrave; la recherche de formes th&eacute;&acirc;trales&nbsp;radicales en prise directe avec le 
 monde, Milo Rau&nbsp;d&eacute;veloppe depuis plusieurs ann.es avec sa soci&eacute;t&eacute; de&nbsp;production, 
 International Institute of Political Murder, des&nbsp;oeuvres centr&eacute;es sur la violence et l&rsquo;oppression 
 politique.</p>
<p>Il a particip&eacute; en 2015 au Festival Sens Interdits avec sa&nbsp;cr&eacute;ation 
<a href='http://www.sensinterdits.org/evenement/hate-radio/'><span style='color:#ff0000'><em>Hate Radio</em></span></a> 
issue d&rsquo;un travail documentaire sur&nbsp;le g&eacute;nocide rwandais. L&rsquo;artiste revient cette ann&eacute;e 
avec&nbsp;<em>Oreste &agrave; Mossoul</em>, un spectacle autour des trag&eacute;dies&nbsp;d&rsquo;Eschyle qui rassemble 
des artistes europ&eacute;ens et Irakiens&nbsp;dans la ville d&eacute;truite par l&rsquo;Etat Islamique.</p>")
                    ->setCover($this->getReference('blackCover2'))
                    ->setComplete(false)
                    ->setTranslated(false)
                    ->setThumbnail($this->getReference('exilConflitsThumbnail'))
                    ->setLieu("Célestins, Théâtre de Lyon")
                    ->setNote("Date et horaire à préciser")
                ;
        $this->addReference('exilConflits', $horScene1);
        $manager->persist($horScene1);
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
