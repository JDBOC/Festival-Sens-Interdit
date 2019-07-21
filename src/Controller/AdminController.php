<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContentRepository;

/**
 * Main controller for admin page
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * Main Page for the admin site
     * @param  ContentRepository $contentRepository
     * @return Response
     * @Route("/", name="admin_index")
     */
    public function index(ContentRepository $contentRepository):Response
    {
        return $this->render('admin/indexAdmin.html.twig');
    }
}
