<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Search;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Content;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SearchController extends AbstractController
{
    /**
     *@Route("/search/{slug}", name="search")
     */
    public function index(String $slug, Search $search, EntityManagerInterface $manager)
    {
        $data = $manager->getRepository(Content::class)->findAll();

        $key = ['titleFr', 'contentFr', 'countryFr'];
        $attributes = ['attributes' => ['titleFr', 'contentFr', 'countryFr'] ];

        $dataFiltered = $search->filter($data, $attributes, $slug, $key);
        dd($dataFiltered);
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }
}
