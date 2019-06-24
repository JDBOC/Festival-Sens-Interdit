<?php

    namespace App\Controller;

  use App\Entity\Content;
  use App\Entity\SiFile;
  use App\Form\ContentType;
  use App\Repository\ContentRepository;
  use App\Service\ContentService;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;

  /**
   * @Route("/content")
   */
class PageContentController extends AbstractController
{
    /**
     * @Route("/", name="content_index", methods={"GET"})
     */
    public function index(ContentRepository $contentRepository): Response
    {
        return $this->render('content/index.html.twig', [
        'contents' => $contentRepository->findAll(),
          ]);
    }
    /**
     * @Route("/new", name="content_new", methods={"GET","POST"})
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
    /**
     * @Route("/{id}", name="content_show", methods={"GET"})
     */
    public function show(Content $content): Response
    {
        return $this->render('content/show.html.twig', [
        'content' => $content,
        ]);
    }
    /**
     * @Route("/{id}/edit", name="content_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Content $content): Response
    {
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('content_index', [
            'id' => $content->getId(),
            'content' => $content
            ]);
        }
          return $this->render('content/edit.html.twig', [
        'content' => $content,
        'form' => $form->createView(),
          ]);
    }
    /**
     * @Route("/{id}", name="content_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Content $content): Response
    {
        if ($this->isCsrfTokenValid('delete'.$content->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($content);
            $entityManager->flush();
        }
        return $this->redirectToRoute('content_index');
    }
    /**
     * Upload a picture and create the related SiFile object with the type in parameter
     *
     * @Route("/{id}/upload/{type}", name="content_delete", methods={"POST"})
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
