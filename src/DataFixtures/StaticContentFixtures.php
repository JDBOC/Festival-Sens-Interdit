<?php

namespace App\DataFixtures;

//use Entité à manipuler
use App\Entity\Content;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StaticContentFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $content = new Content();
        $content->setTitleFr("L'Equipe");
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
        $manager->flush();
    }
}
