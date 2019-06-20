<?php

namespace App\Controller;

use App\Entity\Content;
use App\Entity\SiFile;
use App\Form\ShowType;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use App\Form\ShowSearchType;
use App\Entity\ShowSearch;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

/**
 * @Route("/admin/show")
 */
class ShowController extends AbstractController
{
    /**
     * @Route("/", name="show_index", methods={"GET"})
     */
    public function index(
        ContentRepository $contentRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $search = new ShowSearch();
        $form = $this->createForm(ShowSearchType::class, $search);
        $form->handleRequest($request);

        $shows = $paginator->paginate(
            $contentRepository->findAllShowsQuery($search),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('admin/show/index.html.twig', [
            'contents' => $shows,
            'form' =>  $form->createView()
        ]);
    }

    /**
     * @Route("/new", name="show_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $show = new Content();
        $cover = new SiFile();
        $cover->setType(SiFile::FILE_TYPE['cover']);
        $show->setCover($cover);
        $form = $this->createForm(ShowType::class, $show);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // a passer dans un service
            $show->setContentType(Content::CONTENT_TYPE['show']);
            if (is_null($show->getTitleEn())
                ||  is_null($show->getContentEn())
                ||  is_null($show->getCountryEn()) ) {
                $show->setTranslated(false);
            } else {
                $show->setTranslated(true);
            }
            if (is_null($show->getCountryFr())
                ||  is_null($show->getContentFr())
                ||  empty($show->getSessions())) {
                $show->setComplete(false);
            } else {
                $show->setComplete(true);
            }
            // fin de " a passer dans une service"
                      
            $entityManager->persist($show);
            $entityManager->flush();

            return $this->redirectToRoute('show_index');
        }

        return $this->render('admin/show/new.html.twig', [
            'content' => $show,
            'form' => $form->createView(),
        ]);
    }

    
    /**
     * @Route("/{id}/edit", name="show_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Content $content): Response
    {
        $form = $this->createForm(ShowType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('show_index', [
                'id' => $content->getId(),
            ]);
        }

        return $this->render('admin/show/edit.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="show_edit", methods={"GET","POST"})
     */

    /**
     * @Route("/{id}", name="show_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Content $content): Response
    {
        if ($this->isCsrfTokenValid('delete'.$content->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($content);
            $entityManager->flush();
        }
        return $this->redirectToRoute('show_index');
    }

    /**
     * returns all contents linked to an other content"
     * @Route("/echo/{id}/", name="content_en_echo", methods={"GET","POST"})
     */
    public function indexEchoByContent(
        ContentRepository $contentRepository,
        Request $request,
        Content $content
    ): Response {
        return $this->render('admin/show/echoByContent.html.twig', [
                'contents' => $contentRepository->findAll(),
                'echoContent' => $content,
        ]);
    }

    /**
     * add a content linked to an other content"
     * @Route("/echo_add/{added_id}/{echo_id}", name="add_en_echo", methods={"GET","POST"})
     * @Entity("echoContent", expr="repository.find(echo_id)")
     * @Entity("addedContent", expr="repository.find(added_id)")
     */
    public function addEchoByContent(
        ContentRepository $contentRepository,
        Request $request,
        Content $echoContent,
        Content $addedContent
    ): Response {
        $echoContent->addEnEcho($addedContent);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('content_en_echo', [
                'id' => $echoContent->getId() ]);
    }

       /**
     * remove a content linked to an other content"
     * @Route("/echo_remove/{removed_id}/{echo_id}", name="remove_en_echo", methods={"GET","POST"})
     * @Entity("echoContent", expr="repository.find(echo_id)")
     * @Entity("removedContent", expr="repository.find(removed_id)")
     */
    public function removeEchoByContent(
        ContentRepository $contentRepository,
        Request $request,
        Content $echoContent,
        Content $removedContent
    ): Response {
        $echoContent->removeEnEcho($removedContent);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('content_en_echo', [
                'id' => $echoContent->getId() ]);
    }
}
