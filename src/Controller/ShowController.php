<?php

namespace App\Controller;

use App\Entity\Content;
use App\Form\ContentType;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use App\Form\ShowSearchType;
use App\Entity\ShowSearch;

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
        $content = new Content();
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($content);
            $entityManager->flush();

            return $this->redirectToRoute('content_index');
        }

        return $this->render('content/new.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }
}
