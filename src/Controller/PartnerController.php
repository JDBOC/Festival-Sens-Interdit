<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Entity\SiFile;
use App\Form\PartnerType;
use App\Form\SiFileType;
use App\Repository\PartnerRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $partners = $partnerRepository->findPartner();

        return $this->render(
            'partner/index.html.twig',
            ['partners' => $partners]
        );
    }

    /**
     * @Route("admin/partenaires/new", name="partner_new", methods={"GET","POST"})
     * @return Response
     */
    public function new(Request $request, ObjectManager $manager): Response
    {
        $partner = new Partner();

        $partnerForm = $this->createForm(PartnerType::class, $partner);
        $partnerForm->handleRequest($request);

        if ($partnerForm->isSubmitted() && $partnerForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $logo = $partner->getLogo();
            $logo->setType(SiFile::FILE_TYPE['logo']);

            $type = $request->request->get('type');
            $partner->setType($type);
            $manager->persist($partner);
            $manager->flush();

            return $this->redirectToRoute('partner_index');
        }

        return $this->render('partner/new.html.twig', [
            'partner' => $partner,
            'partnerForm' => $partnerForm->createView(),
        ]);
    }

    /**
     * @Route("admin/partenaires/{id}/edit", name="partner_edit", methods={"GET","POST"})
     * @return Response
     */
    public function edit(Request $request, Partner $partner): Response
    {
        $partnerForm = $this->createForm(PartnerType::class, $partner);
        $partnerForm->handleRequest($request);

        if ($partnerForm->isSubmitted() && $partnerForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partner_index', [
                'id' => $partner->getId(),
            ]);
        }

        return $this->render('partner/edit.html.twig', [
            'partner' => $partner,
            'partnerForm' => $partnerForm->createView(),
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
    public function userIndex(PartnerRepository $partnerRepository):Response
    {
        $partners = $partnerRepository->findPartner();

        return $this->render(
            'partner.html.twig',
            [
                'partners' => $partners
            ]
        );
    }
}
