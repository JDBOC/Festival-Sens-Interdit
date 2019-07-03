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
   
   <p>Textes : eduardo Bernal, Jorge A. vargas, Gabriel Contreras.<br>
   Extraits du texte de Prometeo de Rodrigo Garcia.<br>
   Mise en scène : Jorge A. Vargas<br>
   Création/conception : Eduardo Bernal et Jorge A. Vargas<br>
   <br>
   <br>
   Avec <br>
   Zuadd atal, Vianey Salinas, Gilberto Barraza, Alicia Laguna, Malcolm Vargas<br>
   Musique <br>
   Jesus Cueva (saxophone et chant), Francesco Quartucci (accordéon), Gregorio Rodriguez Orozco (guitare)<br>
   Scénographie et création lumières<br>
   Jesus Hernandez<br>
   Création sonore et musique originale<br>
   Jorge Verdin<br>
   Images et vidéo<br>
   Marina Espana, Malcolm Vargas<br>
   Assistante mise en scène<br>
   Fabiola Mata<br>
   Production exécutive<br>
   Alicia Laguna<br>
   Coordination de production (Mexique)<br>
   Patricia Diaz<br>
   Assistant de production<br>
   Moisés Flores
   </p>
   <p>Production : <br>
   Teatro Linea de Sombra<br>
   Production déléguée France :<br>
   Association Sens Interdits<br>
   Avec le soutien du Fondo Nacional por la Cultura y las Artes(FONCA)<br>
   Jorge A. Vargas est membre du Sistema Nacional de Creadores de Arte<br>
   Avec le soutien de l\'Office National de Diffusion Artistique < br><br >
    Co - Réalisation Festival Sens Interdits et Théâtre de la Croix - Rousse </p >
    \')
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
