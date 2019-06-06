<?php

namespace App\Controller;

use App\Entity\Content;
use App\Form\ContentType;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/page")
 */
class PageContentController extends AbstractController
{
    /**
     * @Route("/", name="page_index", methods={"GET"})
     */
    public function index(ContentRepository $contentRepository): Response
    {
        return $this->render('admin/page/index.html.twig', [
            'contents' => $contentRepository->findAll(),
        ]);
    }
    
    /**
     * @Route("/new", name="page_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $content = new Content();
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($content);
            $entityManager->flush();
            
            return $this->redirectToRoute('page_index');
        }
        
        return $this->render('admin/page/new.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/{id}", name="page_show", methods={"GET"})
     */
    public function show(Content $content): Response
    {
        return $this->render('admin/page/show.html.twig', [
            'content' => $content,
        ]);
    }
    
    /**
     * @Route("/{id}/edit", name="page_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Content $content): Response
    {
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('page_index', [
                'id' => $content->getId(),
            ]);
        }
        
        return $this->render('admin/page/edit.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/{id}", name="page_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Content $content): Response
    {
        if ($this->isCsrfTokenValid('delete' . $content->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($content);
            $entityManager->flush();
        }
        
        return $this->redirectToRoute('page_index');
    }
}
