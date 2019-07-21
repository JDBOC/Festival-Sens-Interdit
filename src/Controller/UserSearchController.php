<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Search;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Content;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UserSearchController extends AbstractController
{

   /**
    *@Route("/search/", name="search", methods="GET")
    */
    public function index(Search $search, EntityManagerInterface $manager)
    {
        $value = $_GET['search'];
        $data = $manager->getRepository(Content::class)->createQueryBuilder('c')
                                                       ->addSelect(['c.titleFr',
                                                           'c.contentFr',
                                                           'c.id',
                                                           'c.slug',
                                                           'c.countryFr',
                                                           'c.lieu',
                                                           'c.author',
                                                           'c.director',
                                                           ])
                                                       ->getQuery()
                                                       ->getResult();
        $key = [
           ['name' => 'titleFr','weight' => 0.4],
           ['name' => 'contentFr','weight' => 0.6],
           ['name' => 'countryFr','weight' => 0.3],
           ['name' => 'lieu','weight' => 0.6],
           ['name' => 'author','weight' => 0.5],
           ['name' => 'director','weight' => 0.5]
           ];

        $dataFiltered = $search->filter($data, $value, $key);

        return $this->render('search.html.twig', [
           'infoSearchs' => $dataFiltered,
        ]);
    }
}
