<?php

namespace App\Controller;

use App\Repository\TarifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Content;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ContentRepository;
use App\Repository\SiFileRepository;
use App\Form\ContactType;

class UserContentController extends AbstractController
{
    /**
     * @Route("/content/{slug}", name="show_content", methods={"GET"})
     */
    public function showContent(Content $content, TarifRepository $tarifRepository): Response
    {
        return $this->render('UserTemplate/userContent/contentShow.html.twig', [
            'content'   => $content,
            'tarifs' => $tarifRepository->findAll()
        ]);
    }

    /**
     * @Route("/news", name="news_index")
     */
    public function newsIndex(ContentRepository $contentRepository, SiFileRepository $pictures)
    {


        return $this->render('news/index.html.twig', [
            'contents' => $contentRepository->findby(['contentType' => 2]),
            'pictures' => $pictures->findAll()
        ]);
    }


     /**
      * @Route("/news/{id}/details", name="news_details")
      */
    public function newsDetails(Content $content)
    {

        return $this->render('news/details.html.twig', [
            'content' => $content
        ]);
    }
}
