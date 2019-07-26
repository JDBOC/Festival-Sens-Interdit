<?php

namespace App\DataFixtures;

use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Content;
use App\Service\ContentService;

class ShowContentFixtures extends Fixture implements DependentFixtureInterface
{

    private $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function load(ObjectManager $manager)
    {
        
        $show = new Content;
        $show   ->setTitleFr('Banos Rama')
                ->setSlug($this->contentService->slugAndCheck($show->getTitleFr()))
                ->setEdition($this->getReference('edition'))
                ->setCountryFr('Mexique')
                ->addTheme($this->getReference('themeMexique'))
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
                ->setSlug($this->contentService->slugAndCheck($show2->getTitleFr()))
                ->setEdition($this->getReference('edition'))
                ->setCountryFr('Mexique')
                ->setContentType(Content::CONTENT_TYPE['festival'])
                ->setComplete(false)
                ->setTranslated(false)
                ->setThumbnail($this->getReference('antartiqueThumbnail'))
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
                ->setDuree('1h15')
                ->setLieu('theatre de la croix rousse')
                ->setNote('Spectacle espagnol, surtitré en français </br>
                    Conseillé à partir de 15 ans.')
                ->setAuthor('Eduardo Bernal, Jorge A. Vargas, Gabriel Contreras')
                ->setDirector('Jorge A. Vargas')
                ->addLogo($this->getReference('croixRousse'))
                ->addLogo($this->getReference('onda'))
                ;
        $this->addReference('showAntartique', $show2);
        $manager->persist($show2);

        $show3 = new Content;
        $show3   ->setTitleFr('Constitution')
                ->setSlug($this->contentService->slugAndCheck($show3->getTitleFr()))
                ->setEdition($this->getReference('edition'))
                ->setCountryFr('Mexique')
                ->setContentType(Content::CONTENT_TYPE['festival'])
                ->setComplete(false)
                ->setTranslated(false)
                ->setThumbnail($this->getReference('constitutionThumbnail'))
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
                ->setDuree('1h15')
                ->setLieu('theatre de la croix rousse')
                ->setNote('Spectacle espagnol, surtitré en français </br>
                    Conseillé à partir de 15 ans.')
                ->setAuthor('Eduardo Bernal, Jorge A. Vargas, Gabriel Contreras')
                ->setDirector('Jorge A. Vargas')
                ->addLogo($this->getReference('croixRousse'))
                ->addLogo($this->getReference('onda'))
                ;
        $this->addReference('showConstitution', $show3);
        $manager->persist($show3);


        $show4 = new Content;
        $show4   ->setTitleFr('Girls boys love cash')
                ->setSlug($this->contentService->slugAndCheck($show4->getTitleFr()))
                ->setEdition($this->getReference('edition'))
                ->setCountryFr('Mexique')
                ->setContentType(Content::CONTENT_TYPE['festival'])
                ->setComplete(false)
                ->setTranslated(false)
                ->setThumbnail($this->getReference('girlsCashThumbnail'))
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
                ->setDuree('1h15')
                ->setLieu('theatre de la croix rousse')
                ->setNote('Spectacle espagnol, surtitré en français </br>
                    Conseillé à partir de 15 ans.')
                ->setAuthor('Eduardo Bernal, Jorge A. Vargas, Gabriel Contreras')
                ->setDirector('Jorge A. Vargas')
                ->addLogo($this->getReference('croixRousse'))
                ->addLogo($this->getReference('onda'))
                ;
        $this->addReference('showGirlsCash', $show4);
        $manager->persist($show4);


        $show5 = new Content;
        $show5   ->setTitleFr('Tijuana')
                ->setSlug($this->contentService->slugAndCheck($show5->getTitleFr()))
                ->setEdition($this->getReference('edition'))
                ->setCountryFr('Mexique')
                ->setContentType(Content::CONTENT_TYPE['festival'])
                ->setComplete(false)
                ->setTranslated(false)
                ->setThumbnail($this->getReference('tijuanaThumbnail'))
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
                ->setDuree('1h15')
                ->setLieu('theatre de la croix rousse')
                ->setNote('Spectacle espagnol, surtitré en français </br>
                    Conseillé à partir de 15 ans.')
                ->setAuthor('Eduardo Bernal, Jorge A. Vargas, Gabriel Contreras')
                ->setDirector('Jorge A. Vargas')
                ->addLogo($this->getReference('croixRousse'))
                ->addLogo($this->getReference('onda'))
                ;
        $this->addReference('showTijuana', $show5);
        $manager->persist($show5);

        $horScene1 = new Content;
        $horScene1  ->setTitleFr('Rencontre avec Milo Rau')
                    ->setSlug($this->contentService->slugAndCheck($horScene1->getTitleFr()))
                    ->setEdition($this->getReference('edition'))
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

        $tournee = new Content;
        $tournee  ->setTitleFr('Nord-Est')
                    ->setSlug($this->contentService->slugAndCheck($tournee->getTitleFr()))
                    ->setContentType(Content::CONTENT_TYPE['tournée'])
                    ->setContentFr("<h2><span style='color:#e74c3c'>Pr&eacute;sentation</span></h2>

<p>Le 23 octobre 2002, au th&eacute;&acirc;tre Doubrovka de Moscou, pendant la repr&eacute;sentation de la
 com&eacute;die musicale&nbsp;<em>Nord-Est</em>, 42 terroristes tch&eacute;tch&egrave;nes surgissent et prennent en 
 otage les 850 spectateurs pr&eacute;sents dans la salle. R&eacute;clamant le retrait des forces russes en
  Tch&eacute;tch&eacute;nie, ils entrent en n&eacute;gociation avec la police. Mais apr&egrave;s trois jours
   d&rsquo;&eacute;changes tendus entre preneurs d&rsquo;otage et forces sp&eacute;ciales, l&rsquo;assaut est
    donn&eacute; par ces derni&egrave;res portant le bilan &agrave;&nbsp;130&nbsp;morts.<br />
Sur sc&egrave;ne, ARTiSHOCK donne la parole &agrave; trois personnages f&eacute;minins&nbsp;: terroriste, otage et
 m&eacute;decin. Celles-ci croisent leurs regards pour d&eacute;voiler aux spectateurs les m&eacute;canismes et les 
 causes menant &agrave;&nbsp;une telle explosion de violence. M&eacute;lange d&rsquo;interviews, de documents 
 vid&eacute;o authentiques, mais aussi de r&eacute;cits fictifs,&nbsp;<em>Nord-Est</em>&nbsp;d&eacute;peint une sale 
 guerre o&ugrave;, entre terrorisme et violence d&rsquo;&Eacute;tat, il n&rsquo;y a ni bien, ni mal, ni&nbsp;vaincu, ni
  vainqueur.</p>

<h2><span style='color:#e74c3c'>Distribution</span></h2>

<p>Auteur :&nbsp;<strong>Torsten Buchsteiner</strong><br />
Mise en sc&egrave;ne :&nbsp;<strong>Galina Pyanova, ARTiSHOCK&nbsp;Theater (театр artишок)</strong></p>

<p>Avec :<strong> Kuantay Abdimadi, Anton Bolkunov, Anna Fedorova, Aleksey Kachshin, Chingiz Kapin, Dmitriy Kopylov,
 Nursultan Mukhamedjanov, Victoriya Mukhamedjanova, Galina Pyanova, Anastassiya Tarassova, Temir Ukushev </strong></p>

<p>Texte français :&nbsp;<strong>Pascal Paul-Harang</strong>&nbsp;<br />
Lumi&egrave;re et sc&eacute;nographie :&nbsp;<strong>Anton Bolkunov</strong>&nbsp;<br />
Son :&nbsp;<strong>Yaroslav Korchevskiy</strong>&nbsp;<br />
Vid&eacute;o :<strong>&nbsp;Vyacheslav Kuznetsov</strong></p>

<p>Production :&nbsp;<strong>Th&eacute;&acirc;tre ARTiSHOCK</strong><br />
Avec le soutien de<strong>&nbsp;l&rsquo;ONDA &ndash; Office National de&nbsp;Diffusion Artistique</strong></p>

<h2><span style='color:#e74c3c'>Dans la presse</span></h2>

<p>Consultez <a href='http://www.sensinterdits.org/wp-content/uploads/2017/11/RDP_Nord-Est.pdf'>la revue de presse</a>
 en ligne.</p>
")
                    ->setComplete(false)
                    ->setTranslated(false)
                    ->setThumbnail($this->getReference('nordEstThumbnail'))
                    ->addPicture($this->getReference('nordEstPicture1'))
                    ->addPicture($this->getReference('nordEstPicture2'))
                    ->addPicture($this->getReference('nordEstPicture3'))
                    ->setNote("Spectacle en russe, surtitré en français")
                    ->setDuree("2h")
                    ->setAuthor(" Torsten Buchsteiner")
                    ->setDirector("Galina Pyanova, Artishock Theater (театр artишок)")
                    ->setCountryFr("Kazakhstan")
                ;
        $this->addReference('tournee', $tournee);
        $manager->persist($tournee);

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
