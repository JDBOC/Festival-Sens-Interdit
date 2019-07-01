<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Form\PartnerType;
use App\Entity\SiFile;
use App\Form\SiFileType;
use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityRepository;

/**
 * Manage Partner's entity
 * @route("/")
 */
class PartnerController extends AbstractController
{
    /**
     * @Route("admin/partenaires", name="partner_index", methods={"GET"})
     * @return Response
     */
    public function index(PartnerRepository $partnerRepository): Response
    {
        $partners = $partnerRepository->findBy(
            [],
            ['type' => 'ASC']
        );

        return $this->render(
            'partner/index.html.twig',
            ['partners' => $partners]
        );
    }

    /**
     * @Route("admin/partenaires/new", name="partner_new", methods={"GET","POST"})
     * @return Response
     */
    public function new(Request $request): Response
    {
        $partner = new Partner();

        $PartnerForm = $this->createForm(PartnerType::class, $partner);
        $PartnerForm->handleRequest($request);

        if ($PartnerForm->isSubmitted() && $PartnerForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $logo = $partner->getLogo();
            $logo->setType(SiFile::FILE_TYPE['logo']);

            $entityManager->persist($partner);
            $entityManager->flush();

            return $this->redirectToRoute('partner_index');
        }

        return $this->render('partner/new.html.twig', [
            'partner' => $partner,
            'PartnerForm' => $PartnerForm->createView(),
        ]);
    }

    /**
     * @Route("admin/partenaires/{id}/edit", name="partner_edit", methods={"GET","POST"})
     * @return Response
     */
    public function edit(Request $request, Partner $partner): Response
    {
        $PartnerForm = $this->createForm(PartnerType::class, $partner);
        $PartnerForm->handleRequest($request);

        if ($PartnerForm->isSubmitted() && $PartnerForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partner_index', [
                'id' => $partner->getId(),
            ]);
        }

        return $this->render('partner/edit.html.twig', [
            'partner' => $partner,
            'PartnerForm' => $PartnerForm->createView(),
        ]);
    }

    /**
     * @Route("admin/partenaires/{id}", name="partner_delete", methods={"DELETE"})
     * @return Response
     */
    public function delete(Request $request, Partner $partner): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partner->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($partner);
            $entityManager->flush();
        }

        return $this->redirectToRoute('partner_index');
    }

    /**
     * @Route("partenaires", name="user_partner")
     * @return Response
     */
    public function userIndex():Response
    {
        $partner_type = $this->getDoctrine()->getRepository('App:Partner')->findAll();

        return $this->render(
            'partner.html.twig',
            [
                'partners' => $partner_type
            ]
        );
    }
}
