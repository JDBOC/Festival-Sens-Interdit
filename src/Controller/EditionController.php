<?php

namespace App\Controller;

use App\Entity\Edition;
use App\Entity\SiFile;
use App\Form\EditionType;
use App\Repository\EditionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/edition")
 */
class EditionController extends AbstractController
{
    /**
     * @Route("/", name="edition_index", methods={"GET"})
     */
    public function index(EditionRepository $editionRepository): Response
    {
        return $this->render('admin/edition/index.html.twig', [
            'editions' => $editionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="edition_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $edition = new Edition();
        $siFile = new SiFile();

        $form = $this->createForm(EditionType::class, $edition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $status = $request->request->get('status');
            $edition->setStatus($status);
            $siFile->setType(SiFile::FILE_TYPE['editionPicture']);

            $entityManager->persist($edition);
            $entityManager->persist($siFile);

            $entityManager->flush();

            return $this->redirectToRoute('edition_index');
        }

        return $this->render('admin/edition/new.html.twig', [
            'edition' => $edition,
            'formEdition' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="edition_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Edition $edition): Response
    {
        $form = $this->createForm(EditionType::class, $edition);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('edition_index', [
                'id' => $edition->getId(),
            ]);
        }

        return $this->render('admin/edition/edit.html.twig', [
            'edition' => $edition,
            'formEdition' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="edition_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Edition $edition): Response
    {
        if ($this->isCsrfTokenValid('delete'.$edition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($edition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('edition_index');
    }
}
