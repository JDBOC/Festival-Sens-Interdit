<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contactForm(Request $request, \Swift_Mailer $mailer)
    {
        $url = $request->request->get('url');

        if ($request->getMethod() == 'POST') {
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $from = $request->request->get('email');
            $contactMessage = $request->request->get('message');

            $message = (new \Swift_Message('Nouvelle demande de contact'))
                ->setFrom('cmandonnet@gmail.com')
                ->setTo('cmandonnet@gmail.com')
                ->setReplyTo($from)
                ->setBody("Mail de $nom  $prenom ($from)
                Message : 
                $contactMessage");

            $mailer->send($message);
            $this->addFlash('success', "Votre message a bien été envoyé.");

            return $this->redirect($url);
        }

        $this->addFlash('danger', "Votre message n'a pas pu être envoyé, veuillez réessayer plus tard.");
        return $this->redirectToRoute($url);
    }
}
