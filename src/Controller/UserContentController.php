<?php

namespace App\Controller;

use App\Entity\Tarif;
use App\Repository\TarifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Content;
use App\Entity\SiFile;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ContentRepository;
use App\Repository\SifileRepository;
use App\Form\ContactType;

class UserContentController extends AbstractController
{
    /**
     * @Route("/show/{id}", name="show_content", methods={"GET"})
     */
    public function showContent(Content $content, TarifRepository $tarifRepository): Response
    {
        $contactForm = $this->createForm(ContactType::class);

        return $this->render('userContent/contentShow.html.twig', [
            'content'   => $content,
            'contactForm' => $contactForm->createView(),
            'tarifs' => $tarifRepository->findAll()
        ]);
    }

    /**
     * @Route("/news", name="news_index")
     */
    public function newsShow(ContentRepository $contentRepository)
    {


        return $this->render('news/index.html.twig', [
            'contents' => $contentRepository->findby(['contentType' => 2]),
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
