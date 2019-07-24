<?php

namespace App\Controller;

use App\Entity\Content;
use App\Entity\SiFile;
use App\Entity\Theme;
use App\Entity\ShowSearch;
use App\Entity\RelatedContentSearch;
use App\Form\ShowType;
use App\Form\PreFormType;
use App\Form\ShowSearchType;
use App\Form\NewsType;
use App\Form\StaticType;
use App\Form\RelatedContentSearchType;
use App\Repository\ContentRepository;
use App\Repository\ThemeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Knp\Component\Pager\PaginatorInterface;
use App\Service\ContentService;

/**
 * Manage routes to admin all kind of contents
 * @Route("/admin/content")
 */
class AdminContentController extends AbstractController
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
        return $this->render('admin/content/index.html.twig', [
            'contents' => $shows,
            'form' =>  $form->createView()
        ]);
    }

   

    /**
     * @Route("/new", name="show_new", methods={"GET","POST"})
     */
    public function new(Request $request, ContentService $contentService): Response
    {
        $content = new Content();
        $form = $this->createForm(PreFormType::class, $content);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $content->setTitleFr('titre')
                    ->setSlug($contentService->slugAndCheck($content->getTitleFr()))
                    ->setTranslated($contentService->checkTanslated($content))
                    ->setComplete($contentService->checkComplete($content));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($content);
            $entityManager->flush();

            // $form = $this->createForm(showType::class, $content);
            return $this->redirectToRoute('show_edit', ['content'=>$content , 'id'=>$content->getId()]);
        }

        return $this->render('admin/content/new.html.twig', [
                'form' =>  $form->createView()
            ]);
    }
   
    /**
     * @Route("/{id}/duplicate", name="show_duplicate", methods={"GET","POST"})
     */
    public function duplicate(Request $request, Content $content): Response
    {
        if ($content->getContentType() != 3) {
            $newContent = clone $content;
            $newContent->setId(null)
                        ->setCover(null)
                        ->setThumbnail(null)
                        ->setCarouselPicture(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newContent);
            $entityManager->flush();
            return $this->redirectToRoute('show_edit', ['content'=>$newContent , 'id'=>$newContent->getId()]);
        }
        return $this->redirectToRoute('show_index');
    }

    /**
     * @Route("/{id}/edit", name="show_edit", methods={"GET","POST","DELETE"})
     */
    public function edit(Request $request, Content $content, ContentService $contentService): Response
    {
        $form = $this->createForm(ShowType::class, $content);
        switch ($content->getContentType()) {
            case 1: //festival
                $form = $this->createForm(ShowType::class, $content);
                break;
            
            case 2: //actualité
                $form = $this->createForm(NewsType::class, $content);
                break;
            
            case 3: //static_page
                $form = $this->createForm(StaticType::class, $content);
                break;
            
            case 4: //hors scène
                $form = $this->createForm(ShowType::class, $content);
                break;
            
            case 5: //tournée
                $form = $this->createForm(ShowType::class, $content);
                break;
        }
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($content);
            if ($content->getThumbnail() != null) {
                $content->getThumbnail()->setType(5);
            }
                ;
            if ($content->getCover() != null) {
                $content->getCover()->setType(1);
            }
                ;

            if ($content->getCarouselPicture() != null) {
                $content->getCarouselPicture()->setType(6);
            }
                ;
           
            $content->setSlug($contentService->slugAndCheck($content->getTitleFr()))
                    ->setTranslated($contentService->checkTanslated($content))
                    ->setComplete($contentService->checkComplete($content));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('show_index', [
                'id' => $content->getId(),
            ]);
        }

        return $this->render('admin/content/edit.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }

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
        PaginatorInterface $paginator,
        Request $request,
        Content $content
    ): Response {
        $relatedSearch = new RelatedContentSearch();
        $form = $this->createForm(RelatedContentSearchType::class, $relatedSearch);
        $form->handleRequest($request);

        $contents = $paginator->paginate(
            $contentRepository->findAllContentQuery($relatedSearch),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/content/echoByContent.html.twig', [
                'contents' => $contents,
                'echoContent' => $content,
                'form' =>  $form->createView()
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

    /**
    * returns all themes linked to an other content"
    * @Route("/themes/{id}", name="content_themes", methods={"GET","POST"})
    */
    public function indexThemesByContent(ThemeRepository $themeRepo, Content $content): Response
    {
        return $this->render('admin/content/themesByContent.html.twig', [
                'themes' => $themeRepo->findAll(),
                'content' => $content
        ]);
    }
    /**
     * add a content linked to an other content"
     * @Route("/theme_add/{theme_id}/{content_id}", name="add_theme", methods={"GET","POST"})
     * @Entity("content", expr="repository.find(content_id)")
     * @Entity("theme", expr="repository.find(theme_id)")
     */
    public function addThemeByContent(
        ContentRepository $contentRepository,
        Request $request,
        Theme $theme,
        Content $content
    ): Response {
        $content->addTheme($theme);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('content_themes', [
                'id' => $content->getId() ]);
    }

    /**
     * remove a content linked to an other content"
     * @Route("/theme_remove/{theme_id}/{content_id}", name="remove_theme", methods={"GET","POST"})
     * @Entity("content", expr="repository.find(content_id)")
     * @Entity("theme", expr="repository.find(theme_id)")
     */
    public function removeThemeByContent(
        ContentRepository $contentRepository,
        Request $request,
        Theme $theme,
        Content $content
    ): Response {
        $content->removeTheme($theme);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('content_themes', [
                'id' => $content->getId() ]);
    }

    /**
     * Upload a picture and create the related SiFile object with the type in parameter
     *
     * @Route("/{id}/upload/{type}", name="content_upload", methods={"POST"})
     * @param Request $request request object
     * @param Content $content related content
     * @param string $type upload type, could be contentPicture or logo
     * @param ContentService $contentService content service
     * @return Response response object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function upload(Request $request, Content $content, string $type, ContentService $contentService): Response
    {
        $response = new Response();
        $result = [];
        $file = $request->files->get('file');
        try {
            $siFile = $contentService->uploadPicture($content, $file, $type);
            $result = [
            'id' => $siFile->getId(),
            'mediaFileName' => $siFile->getMediaFileName(),
            'type' => $siFile->getType()
            ];
        } catch (\Exception $e) {
            $result['error'] = true;
        }
        $response->setContent(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    /**
     * Delete the picture in parameter from the content in parameter.
     * @Route("/{id}/picture/{siFile}")
     * @param Content $content
     * @param SiFile $siFile
     * @param ContentService $contentService
     * @return Response
     */
    public function deletePicture(Content $content, SiFile $siFile, ContentService $contentService): Response
    {
        $contentService->deletePicture($content, $siFile);

        $response = new Response();
        $response->setContent(json_encode(['result' => true]));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
