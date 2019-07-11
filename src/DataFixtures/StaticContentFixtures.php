<?php

namespace App\DataFixtures;

//use Entité à manipuler
use App\Entity\Content;
use App\Entity\SiFile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Service\ContentService;

class StaticContentFixtures extends Fixture
{
    private $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $cover = new SiFile();
        $cover->setType(SiFile::FILE_TYPE['cover']);
        $cover->setMediaFileName("blackCover.jpg");
        $cover->setUpdatedAt(new \DateTime("now"));
        $content = new Content();
        $content->setTitleFr("L'Equipe")
        ->setTitleEn("Our Team")
        ->setSlug($this->contentService->slugAndCheck($content->getTitleFr()))
        ->setContentFr("
<p>Patrick Penot &ndash; dir.asso.sensinterdits@gmail.com<br />
<strong>Directeur </strong></p>

<p>Aur&eacute;lie Maurier &ndash; adm.sensinterdits@gmail.com<br />
<strong>Administratrice de production</strong></p>

<p>Tina Hollard &ndash; prod.sensinterdits@gmail.com<br />
<strong>Charg&eacute;e de production </strong>assist&eacute;e de Laura Maldonado</p>

<p>Claire Chaize &ndash; rp.sensinterdits@gmail.com<br />
<strong>Charg&eacute;e des relations aupr&egrave;s des publics </strong>assist&eacute;e de Marianne Lefort</p>

<p>Sonia Cova &ndash; presse.sensinterdits@gmail.com<br />
<strong>Charg&eacute;e de communication &amp; des relations presse </strong>
assist&eacute;e de Adrianne Breznay et Andr&eacute;a Chamblas</p>

<p>&ndash;</p>

<p>Catherine Marion<br />
<strong>Pr&eacute;sidente</strong></p>

<p>Chantal Kirchner<br />
<strong>Vice-pr&eacute;sidente</strong></p>
</hr>
<p><strong>Vice-pr&eacute;sidente</strong></p>

<p>Anne Durufl&eacute;<br />
<strong>Tr&eacute;sori&egrave;re / Secr&eacute;taire</strong></p>

<p>Philippe Bachet<br />
<strong>Membre du bureau</strong></p>

<p>Bernard Faivre d&rsquo;Arcier, Claire Lasne-Darcueil, Michel Bataillon<br />
<strong>Membres d&rsquo;honneur</strong>&nbsp;</p>

<p>Jacques Fayard, Olivier Neveux<br />
<strong>Comit&eacute; des Sages</strong>&nbsp;</p>
")
        ->setCover($cover)
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false)
        ;

        $manager->persist($content);

        //fixture page festival
        $cover = new SiFile();
        $cover->setType(SiFile::FILE_TYPE['cover']);
        $cover->setMediaFileName("blackCover.jpg");
        $cover->setUpdatedAt(new \DateTime("now"));
        $festival = new Content();
        $festival ->setTitleFr("Le festival")
                ->setTitleEn("the festival")
                  ->setCover($cover)
                  ->setSlug($this->contentService->slugAndCheck($festival->getTitleFr()))
                  ->setContentFr("données du festival")
                  ->setContentType(Content::CONTENT_TYPE['static_page'])
                  ->setComplete(true)
                  ->setTranslated(false)
                  ;
        $manager  ->persist($festival);

        //fixture page l'association
        $cover = new SiFile();
        $cover->setType(SiFile::FILE_TYPE['cover']);
        $cover->setMediaFileName("blackCover.jpg");
        $cover->setUpdatedAt(new \DateTime("now"));
        $association = new Content();
        $association->setTitleFr("L'association")
        ->setTitleEn("the association")
        ->setCover($cover)
        ->setSlug($this->contentService->slugAndCheck($association->getTitleFr()))
        ->setContentFr("données de l'association")
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false)
        ;
        $manager->persist($association);

        //fixture page Ecole éphémère
        $cover = new SiFile();
        $cover->setType(SiFile::FILE_TYPE['cover']);
        $cover->setMediaFileName("blackCover.jpg");
        $cover->setUpdatedAt(new \DateTime("now"));
        $ecoleEphemere = new Content();
        $ecoleEphemere->setTitleFr("Ecole Ephémère")
        ->setCover($cover)
        ->setSlug($this->contentService->slugAndCheck($ecoleEphemere->getTitleFr()))
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false)
        ;
        $manager->persist($ecoleEphemere);

        //fixture page action médiation
        $cover = new SiFile();
        $cover->setType(SiFile::FILE_TYPE['cover']);
        $cover->setMediaFileName("blackCover.jpg");
        $cover->setUpdatedAt(new \DateTime("now"));
        $mediation = new Content();
        $mediation->setTitleFr("Actions de médiation")
        ->setTitleEn("Mediation actions")
        ->setCover($cover)
        ->setSlug($this->contentService->slugAndCheck($mediation->getTitleFr()))
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false)
        ;
        $manager->persist($mediation);

        //fixture page chapiteau
        $cover = new SiFile();
        $cover->setType(SiFile::FILE_TYPE['cover']);
        $cover->setMediaFileName("blackCover.jpg");
        $cover->setUpdatedAt(new \DateTime("now"));
        $chapiteau = new Content();
        $chapiteau->setTitleFr("Le Chapiteau")
        ->setCover($cover)
        ->setSlug($this->contentService->slugAndCheck($chapiteau->getTitleFr()))
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false)
        ;
        $manager->persist($chapiteau);

        //fixture page lieux et accès
        $cover = new SiFile();
        $cover->setType(SiFile::FILE_TYPE['cover']);
        $cover->setMediaFileName("blackCover.jpg");
        $cover->setUpdatedAt(new \DateTime("now"));
        $lieuxEtAcces = new Content();
        $lieuxEtAcces->setTitleFr("Lieux et Accès")
        ->setTitleEn("How to get there")
        ->setCover($cover)
        ->setSlug($this->contentService->slugAndCheck($lieuxEtAcces->getTitleFr()))
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false)
        ;
        $manager->persist($lieuxEtAcces);

        //fixture page Webradio
        $cover = new SiFile();
        $cover->setType(SiFile::FILE_TYPE['cover']);
        $cover->setMediaFileName("blackCover.jpg");
        $cover->setUpdatedAt(new \DateTime("now"));
        $webRadio = new Content();
        $webRadio->setTitleFr("Web radio")
        ->setCover($cover)
        ->setSlug($this->contentService->slugAndCheck($webRadio->getTitleFr()))
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false)
        ;
        $manager->persist($webRadio);

        //fixture page Nous soutenir
        $cover = new SiFile();
        $cover->setType(SiFile::FILE_TYPE['cover']);
        $cover->setMediaFileName("blackCover.jpg");
        $cover->setUpdatedAt(new \DateTime("now"));
        $nousSoutenir = new Content();
        $nousSoutenir->setTitleFr("Nous soutenir")
        ->setTitleEn("Support Us")
        ->setCover($cover)
        ->setSlug($this->contentService->slugAndCheck($nousSoutenir->getTitleFr()))
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false)
        ;
        $manager->persist($nousSoutenir);

        $manager->flush();
    }
}
