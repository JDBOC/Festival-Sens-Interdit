<?php

namespace App\Controller;

use App\Entity\Content;
use App\Form\ShowType;
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
        $show = new Content();
        $form = $this->createForm(ShowType::class, $show);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // a passer dans un service
            $show-> setContentType(Content::CONTENT_TYPE['show']);
            if (is_null($show->getTitleEn())
                ||  is_null($show->getContentEn())
                ||  is_null($show->getCountryEn()) ) {
                $show->setTranslated(false);
            } else {
                $show->setTranslated(true);
            }
            if (is_null($show->getCountryFr())
                ||  is_null($show->getContentFr())
                ||  empty($show->getPicture())
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
}
