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
     * @Route("/", name="index_festival")
     */
    public function indexFestival(ContentRepository $contentRepo, EditionRepository $EditionRepo): Response
    {

        $topActus = $contentRepo->findBy(['topArticle' => true]);
        $currentEdition = $EditionRepo->findOneBy(['status'=>'en ligne']);

        if ($currentEdition) {
            $interval = new \DateInterval('P1D');
            $dateRangeTmp = new \DatePeriod($currentEdition->getDateDebut(), $interval, $currentEdition->getDateFin());
            foreach ($dateRangeTmp as $date) {
                $dateRange[] = $date;
            }
            $dateRange[] = $currentEdition->getDateFin();

            return $this->render(
                'indexFestival.html.twig',
                [
                    'contents' => $contentRepo->findby(['contentType' => Content::CONTENT_TYPE['festival']]),
                    'period'=>$dateRange,
                    'topActus' => $topActus
                ]
            );
        } else {
            return $this->render('UserTemplate/indexHorsFestival.html.twig', [
                    'topActus' => $topActus
                ]);
        }
    }
    
    /**
     * index des sessions pour une date donnée en festival
     * @Route("/festival/byDate/{sessionDate}", name="index_by_date", methods={"GET","POST"})
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
            'indexFestivalByDate.html.twig',
            [
                        'sessions' => $sessionRepo->findContentByDate($sessionDate),
                        'sessionDate' => $sessionDate,
                        'language' => $language,
                        'period'=>$dateRange
            ]
        );
    }

    /**
     * index des spectacles hors scene  en festival
     * @Route("/hors-scene", name="index_hors_scene")
     */
    public function indexHorsScene(
        ContentRepository $contentRepo,
        EditionRepository $EditionRepo
    ): Response {
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
            'indexHorsScene.html.twig',
            [
                        'contents' => $contentRepo->findby(['contentType' => Content::CONTENT_TYPE['hors scène']]),
                        'language' => $language,
                        'period'=>$dateRange
            ]
        );
    }

    /**
     * index des spectacles en tournée
     * @Route("/tournees", name="index_tournee")
     */
    public function indexTournee(
        ContentRepository $contentRepo
    ): Response {
        $language = $_SESSIONS['language'] = 'fr';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            if ($_POST['language'] == "en_EN") {
                 $language =  $_POST['language'];
            }
        }

        return $this->render(
            'UserTemplate/indexEnTournee.html.twig',
            [
                'contents' => $contentRepo->findby(['contentType' => Content::CONTENT_TYPE['tournée']]),
                'language' => $language,
            ]
        );
    }

     /**
     * index des spectacles en tournée
     * @Route("/translate", name="translate")
     */
    public function translate()
    {
        $session = $this->get('session');
        $session->set('session', array('language' => $_GET['value']));
        $route = explode('::', $_GET['route']);
        $route = $route[1];
        $route = preg_replace("/(?<=\\w)(?=[A-Z])/", "_$1", $route);
        $route = strtolower($route);
        if (isset($_GET['parameters'])) {
            return $this->redirectToRoute($route, array('slug'=> $_GET['parameters']['slug']));
        }
        return $this->redirectToRoute($route);
    }
}
