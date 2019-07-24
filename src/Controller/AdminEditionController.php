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
class AdminEditionController extends AbstractController
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
    public function new(Request $request, EditionRepository $editionRepository): Response
    {
        $edition = new Edition();

        $form = $this->createForm(EditionType::class, $edition);
        $form->handleRequest($request);

        $noBlankFile = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $edition->getStatus() != 'en ligne'? :$editionRepository->setActiveEditionsToArchive();
            $entityManager = $this->getDoctrine()->getManager();

            $edition->getEditionPicture()->setType(3);
            $entityManager->persist($edition);

            $entityManager->flush();

            return $this->redirectToRoute('edition_index');
        } else {
            $noBlankFile = "Image de l'édition nécessaire";
        }

        return $this->render('admin/edition/new.html.twig', [
            'edition' => $edition,
            'formEdition' => $form->createView(),
            'noBlankFile' => $noBlankFile
        ]);
    }


    /**
     * @Route("/{id}/edit", name="edition_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Edition $edition, EditionRepository $editionRepository): Response
    {
        $form = $this->createForm(EditionType::class, $edition);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $edition->getStatus() != 'en ligne'? :$editionRepository->setActiveEditionsToArchive();
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
