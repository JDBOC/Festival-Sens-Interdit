<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContentRepository;

class AdminController extends AbstractController
{
    /**
     * Main Page for the admin site
     * @param  ContentRepository $contentRepository
     * @return Response
     * @Route("/admin", name="admin")
     */
    public function index(ContentRepository $contentRepository):Response
    {
        return $this->render('adminBase.html.twig');
    }
}
