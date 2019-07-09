<?php

namespace App\DataFixtures;

//use Entité à manipuler
use App\Entity\Content;
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
        $content = new Content();
        $content->setTitleFr("L'Equipe");
        $content->setSlug($this->contentService->slugAndCheck($content->getTitleFr()));
        $content->setContentFr("
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
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false)
        ->setCover($this->getReference('blackCover'))
        ;

        $manager->persist($content);

        //fixture page festival
        $festival = new Content();
        $festival ->setTitleFr("Le festival")
                  ->setSlug($this->contentService->slugAndCheck($festival->getTitleFr()))
                  ->setContentFr("données du festival")
                  ->setContentType(Content::CONTENT_TYPE['static_page'])
                  ->setComplete(true)
                  ->setTranslated(false);
        $manager  ->persist($festival);

        //fixture page l'association
        $association = new Content();
        $association->setTitleFr("L'association")
        ->setSlug($this->contentService->slugAndCheck($association->getTitleFr()))
        ->setContentFr("données de l'association")
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false);
        $manager->persist($association);

        //fixture page Ecole éphémère
        $ecoleEphemere = new Content();
        $ecoleEphemere->setTitleFr("Ecole Ephémère")
        ->setSlug($this->contentService->slugAndCheck($ecoleEphemere->getTitleFr()))
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false);
        $manager->persist($ecoleEphemere);

        //fixture page action médiation
        $mediation = new Content();
        $mediation->setTitleFr("Actions de médiation")
        ->setSlug($this->contentService->slugAndCheck($mediation->getTitleFr()))
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false);
        $manager->persist($mediation);

        //fixture page chapiteau
        $chapiteau = new Content();
        $chapiteau->setTitleFr("Le Chapiteau")
        ->setSlug($this->contentService->slugAndCheck($chapiteau->getTitleFr()))
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false);
        $manager->persist($chapiteau);

        //fixture page lieux et accès
        $lieuxEtAcces = new Content();
        $lieuxEtAcces->setTitleFr("Lieux et Accès")
        ->setSlug($this->contentService->slugAndCheck($lieuxEtAcces->getTitleFr()))
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false);
        $manager->persist($lieuxEtAcces);

        //fixture page Webradio
        $webRadio = new Content();
        $webRadio->setTitleFr("Web radio")
        ->setSlug($this->contentService->slugAndCheck($webRadio->getTitleFr()))
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false);
        $manager->persist($webRadio);

        //fixture page Nous soutenir
        $nousSoutenir = new Content();
        $nousSoutenir->setTitleFr("Nous soutenir")
        ->setSlug($this->contentService->slugAndCheck($nousSoutenir->getTitleFr()))
        ->setContentType(Content::CONTENT_TYPE['static_page'])
        ->setComplete(true)
        ->setTranslated(false);
        $manager->persist($nousSoutenir);

        $manager->flush();
    }
}
