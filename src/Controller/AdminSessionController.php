<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Content;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

/**
 * @Route("/admin/session")
 */
class AdminSessionController extends AbstractController
{

    /**
     * @Route("/{id}/new", name="session_by_content", methods={"GET","POST"})
     */
    public function indexByContent(
        ContentRepository $contentRepository,
        SessionRepository $sessionRepository,
        Request $request,
        $id
    ): Response {
        $session = new Session();
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $session->setContent($contentRepository->findOneBy(['id'=>$id]));
            $entityManager->persist($session);
            $entityManager->flush();

            return $this->redirectToRoute('session_by_content', [
                'id' => $id
            ]);
        }
        return $this->render('admin/session/new.html.twig', [
                'sessions' => $sessionRepository->findby(['content' => $id]),
                'content' => $contentRepository->findOneBy(['id'=>$id]),
                'session' => $session,
                'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit/{content_id}", name="session_edit", methods={"GET","POST"})
     * @Entity("content", expr="repository.find(content_id)")
     */
    public function edit(
        Request $request,
        Session $session,
        Content $content,
        SessionRepository $sessionRepository
    ): Response {
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('session_by_content', [
                'id' => $content->getId()
            ]);
        }

        return $this->render('admin/session/edit.html.twig', [
            'session' => $session,
            'form' => $form->createView(),
            'sessions' => $sessionRepository->findby(['content' => $content->getId()]),
            'content' => $content,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="session_delete", methods={"GET"})
     */
    public function delete(Request $request, Session $session): Response
    {
            $contentId = $session->getContent()->getId();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($session);
            $entityManager->flush();

        return $this->redirectToRoute('session_by_content', [
                'id' => $contentId
            ]);
    }
}
