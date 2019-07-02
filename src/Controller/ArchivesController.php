<?php

namespace App\Controller;

use App\Repository\ContentRepository;
use App\Repository\EditionRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/archives")
 */
class ArchivesController extends AbstractController
{
    /**
     * @Route("/", name="archives")
     */
    public function archives(EditionRepository $editionRepository)
    {
        return $this->render('UserTemplate/archives.html.twig', ['editions' => $editionRepository->findAll()]);
    }

    /**
     * @Route("/{id}", name="list_content_edition_archive")
     */
    public function contentEditionArchives(ContentRepository $contentRepository, EditionRepository $editionRepository)
    {
        $edition = $editionRepository->findAll();
        $content = $contentRepository->findby(['edition' => $edition]);
        return $this->render(
            'UserTemplate/editionArchives.html.twig',
            ['contents' => $content]
        );
    }
}
