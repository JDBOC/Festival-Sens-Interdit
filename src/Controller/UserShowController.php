<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Content;
use App\Entity\SiFile;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ContentRepository;
use App\Repository\SifileRepository;
use App\Form\ContactType;

class UserShowController extends AbstractController
{
    /**
     * @Route("/show/{id}", name="show_show", methods={"GET"})
     */
    public function show(Content $content): Response
    {
        $contactForm = $this->createForm(ContactType::class);

        return $this->render('userContent/show.html.twig', [
            'show'   => $content,
            'contactForm' => $contactForm->createView()
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
