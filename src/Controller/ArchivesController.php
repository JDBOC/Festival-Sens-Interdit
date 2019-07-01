<?php

namespace App\Controller;

use App\Repository\EditionRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArchivesController extends AbstractController
{
    /**
     * @Route("/archives", name="archives")
     */
    public function archives(EditionRepository $editionRepository)
    {
        return $this->render('UserTemplate/archives.html.twig', ['editions' => $editionRepository->findAll()]);
    }
}
