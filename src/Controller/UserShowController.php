<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserShowController extends AbstractController
{
    /**
     * @Route("/user/show", name="user_show")
     */
    public function userShow()
    {
        return $this->render('user_show/index.html.twig', [
            'controller_name'   => 'UserShowController',
        ]);
    }
}
