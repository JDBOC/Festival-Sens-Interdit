<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ContentRepository;
use App\Repository\SessionRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(SessionRepository $session): Response
    {

        return $this->render(
            'index.html.twig',
            [
                        'sessions' => $session->findAll()
                    ]
        );
    }
}
