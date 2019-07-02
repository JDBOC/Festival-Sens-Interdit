<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ContentRepository;
use App\Repository\EditionRepository;
use App\Repository\SessionRepository;
use App\Entity\Content;

class HomeController extends AbstractController
{
    /**
     * index des spectacles en festival
     * @Route("/", name="index")
     */
    public function index(ContentRepository $contentRepo, EditionRepository $EditionRepo): Response
    {
        $language = $_SESSIONS['language'] = 'fr';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            if ($_POST['language'] == "en_EN") {
                 $language =  $_POST['language'];
            }
        }

        $currentEdition = $EditionRepo->findOneBy(['status'=>'en ligne']);
        $interval = new \DateInterval('P1D');
        $dateRangeTmp = new \DatePeriod($currentEdition->getDateDebut(), $interval, $currentEdition->getDateFin());
        foreach ($dateRangeTmp as $date) {
            $dateRange[] = $date;
        }
        $dateRange[] = $currentEdition->getDateFin();

        return $this->render(
            'index.html.twig',
            [
                        'contents' => $contentRepo->findby(['contentType' => Content::CONTENT_TYPE['festival']]),
                        'language' => $language,
                        'period'=>$dateRange
            ]
        );
    }
    
    /**
     * index des sessions pour une date donnée
     * @Route("/{sessionDate}", name="index_by_date")
     */
    public function indexByDate(
        ContentRepository $contentRepo,
        EditionRepository $EditionRepo,
        SessionRepository $sessionRepo,
        string $sessionDate
    ): Response {
        $language = $_SESSIONS['language'] = 'fr';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            if ($_POST['language'] == "en_EN") {
                 $language =  $_POST['language'];
            }
        }
        $sessionDate = \DateTime::createFromFormat('d-m-Y H:i', $sessionDate." 00:00");
        $currentEdition = $EditionRepo->findOneBy(['status'=>'en ligne']);
        $interval = new \DateInterval('P1D');
        $dateRangeTmp = new \DatePeriod($currentEdition->getDateDebut(), $interval, $currentEdition->getDateFin());
        foreach ($dateRangeTmp as $date) {
            $dateRange[] = $date;
        }
        $dateRange[] = $currentEdition->getDateFin();

        return $this->render(
            'indexOld.html.twig',
            [
                        'sessions' => $sessionRepo->findContentByDate($sessionDate),
                        'language' => $language,
                        'period'=>$dateRange
            ]
        );
    }
}
