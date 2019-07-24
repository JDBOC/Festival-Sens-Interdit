<?php

namespace App\Controller;

use App\Entity\SiFile;
use App\Form\SiFileType;
use App\Repository\SiFileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/sifile")
 */
class AdminSiFileController extends AbstractController
{
    /**

     * @Route("/", name="sifile_index", methods={"GET"})
     */
    public function index(SiFileRepository $siFileRepository): Response
    {
        return $this->render('si_file/index.html.twig', [
            'si_files' => $siFileRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sifile_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $siFile = new SiFile();
        $form = $this->createForm(SiFileType::class, $siFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $siFile->setUpdatedAt(new \DateTime());
            $entityManager->persist($siFile);
            $entityManager->flush();

            return $this->redirectToRoute('file_index');
        }

        return $this->render('si_file/new.html.twig', [
            'si_file' => $siFile,
            'formFile' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sifile_show", methods={"GET"})
     */
    public function show(SiFile $siFile): Response
    {
        return $this->render('si_file/show.html.twig', [
            'si_file' => $siFile,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sifile_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SiFile $siFile): Response
    {
        $form = $this->createForm(SiFileType::class, $siFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $siFile->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sifile_index', [
                'id' => $siFile->getId(),
            ]);
        }

        return $this->render('si_file/edit.html.twig', [
            'si_file' => $siFile,
            'formFile' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sifile_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SiFile $siFile): Response
    {
        if ($this->isCsrfTokenValid('delete'.$siFile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($siFile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sifile_index');
    }
}
