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

        return $this->render('show.html.twig', [
            'show'   => $content,
            'contactForm' => $contactForm->createView()
        ]);
    }
}
