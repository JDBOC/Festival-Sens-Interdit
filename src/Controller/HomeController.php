<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\SessionRepository;
use App\Form\ContactType;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(SessionRepository $session): Response
    {
        $language = $_SESSIONS['language'] = 'fr';

        /*if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            if ($_POST['language'] == "en_EN") {
                $language =  $_POST['language'];
            }
        }*/

        $contactForm = $this->createForm(ContactType::class);

        return $this->render(
            'index.html.twig',
            [
                        'sessions' => $session->findAll(),
                        'language' => $language,
                        'contactForm' => $contactForm->createView()
            ]
        );
    }

 /*   public function contactForm()
    {
        $contactForm = $this->createForm(ContactType::class);

        return $this->render('/footer.html.twig', [
            'contactForm' => $contactForm->createView()
            ]);
    }*/
}
