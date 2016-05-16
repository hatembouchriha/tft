<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Joueur;
use AppBundle\Entity\Media;
use AppBundle\Entity\Message;
use AppBundle\Entity\Partie;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Zend\Json\Expr;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Actualite;
use AppBundle\Form\ActualiteType;

/**
 * Home controller.
 *
 * @Route("/home")
 */
class HomeController extends Controller
{
    /**
     *
     *
     * @Route("/index", name="site_home")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $actualites = $this->getDoctrine()
            ->getRepository('AppBundle:Actualite')
            ->findThree();
        $forActualites = $this->getDoctrine()
            ->getRepository('AppBundle:Actualite')
            ->findFor();
        $allActualites = $em->getRepository('AppBundle:Actualite')->findAll();
        $joueurs = $this->getDoctrine()
            ->getRepository('AppBundle:Joueur')->findFiveOrderedByScore();
        $joueursTun = $this->getDoctrine()
            ->getRepository('AppBundle:Joueur')->findFiveTunisian();
        $match = $this->getDoctrine()
            ->getRepository('AppBundle:Partie')->findLast();
        $matchs = $this->getDoctrine()
            ->getRepository('AppBundle:Partie')->findNextMatches();
        $videos = $this->getDoctrine()
            ->getRepository('AppBundle:Media')->findSixVideos();
        $images = $this->getDoctrine()
            ->getRepository('AppBundle:Media')->findEightImages();

        return $this->render('home/index.html.twig', array(
            'allActualites' => $allActualites,
            'forActualites' => $forActualites,
            'actualites' => $actualites,
            'joueurs' => $joueurs,
            'joueursTun' => $joueursTun,
            'match' => $match,
            'matchs' => $matchs,
            'videos' => $videos,
            'images' => $images,
        ));
    }

    /**
     *
     *
     * @Route("/joueurs", name="site_players")
     * @Method("GET")
     */
    public function joueursAction()
    {
        $em = $this->getDoctrine()->getManager();

        $joueurs = $em->getRepository('AppBundle:Joueur')->findAll();
        $joueursTun = $this->getDoctrine()
            ->getRepository('AppBundle:Joueur')
            ->findTunisian();

        $actualites = $this->getDoctrine()
            ->getRepository('AppBundle:Actualite')
            ->findThree();

        $medias = $this->getDoctrine()
            ->getRepository('AppBundle:Media')
            ->findNine();

        return $this->render('home/joueurs.html.twig', array(
            'joueurs' => $joueurs,
            'joueursTun' => $joueursTun,
            'actualites' => $actualites,
            'medias' => $medias,
        ));
    }

    /**
     *
     *
     * @Route("/ranking", name="site_ranking")
     * @Method("GET")
     */
    public function rankingAction()
    {
        $joueurs = $this->getDoctrine()
            ->getRepository('AppBundle:Joueur')->findAllOrderedByScore();
        $actualites = $this->getDoctrine()
            ->getRepository('AppBundle:Actualite')
            ->findThree();

        $medias = $this->getDoctrine()
            ->getRepository('AppBundle:Media')
            ->findNine();

        $joueursTun = $this->getDoctrine()
            ->getRepository('AppBundle:Joueur')
            ->findTunisianOrderedByScore();

        return $this->render('home/ranking.html.twig', array(
            'joueurs' => $joueurs,
            'joueursTun' => $joueursTun,
            'actualites' => $actualites,
            'medias' => $medias,
        ));
    }

    /**
     *
     *
     * @Route("/news", name="site_news")
     * @Method("GET")
     */
    public function newsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

//        $actualites = $em->getRepository('AppBundle:Actualite')->findAll();
        $dql = "SELECT a FROM AppBundle:Actualite a";
        $query = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('home/news.html.twig', array(
            'actualites' => $pagination,
        ));
    }

    /**
     *
     *
     * @Route("/tournaments", name="site_tournaments")
     * @Method("GET")
     */
    public function tournamentsAction()
    {
        $actualites = $this->getDoctrine()
            ->getRepository('AppBundle:Actualite')
            ->findThree();
        $medias = $this->getDoctrine()
            ->getRepository('AppBundle:Media')
            ->findNine();
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('AppBundle:Evenement')->findAll();

        return $this->render('home/tournaments.html.twig', array(
            'evenements' => $evenements,
            'actualites' => $actualites,
            'medias' => $medias,
        ));
    }

    /**
     *
     *
     * @Route("/contact", name="site_contact")
     * @Method({"GET", "POST"})
     */
    public function contactAction(Request $request)
    {
        $actualites = $this->getDoctrine()
            ->getRepository('AppBundle:Actualite')
            ->findThree();
        $message = new Message();
        $form = $this->createForm('AppBundle\Form\MessageType', $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            var_dump(cc);
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
            return $this->redirectToRoute('site_contact');
        }

        return $this->render('home/contact.html.twig', array(
            'form' => $form->createView(),
            'actualites' => $actualites,
        ));
    }

    /**
     *
     *
     * @Route("/singlenews/{id}", name="single_news")
     * @Method("GET")
     */
    public function singleNewsAction(Actualite $actualite)
    {
        $actualites = $this->getDoctrine()
            ->getRepository('AppBundle:Actualite')
            ->findThree();
        $allActualites = $this->getDoctrine()->getRepository('AppBundle:Actualite')->findAll();
        $medias = $this->getDoctrine()
            ->getRepository('AppBundle:Media')
            ->findNine();

        return $this->render('home/single_news.html.twig', array(
            'actualite' => $actualite,
            'allActualites' => $allActualites,
            'actualites' => $actualites,
            'medias' => $medias,
        ));
    }

    /**
     *
     *
     * @Route("/singleplayer/{id}", name="single_player")
     * @Method("GET")
     */
    public function singlePlayerAction(Joueur $joueur)
    {
        $actualites = $this->getDoctrine()
            ->getRepository('AppBundle:Actualite')
            ->findThree();
        $medias = $this->getDoctrine()
            ->getRepository('AppBundle:Media')
            ->findNine();
        $stats = $this->getDoctrine()
            ->getRepository('AppBundle:Partie')
            ->findWinnedMatches(10);

        return $this->render('home/single_player.html.twig', array(
            'joueur' => $joueur,
            'actualites' => $actualites,
            'medias' => $medias,
            'stats' => $stats,
            'chart' => $this->chartHistogramme($stats),
        ));
    }

    /**
     *
     *
     * @Route("/matchs", name="site_matchs")
     * @Method("GET")
     */
    public function matchsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $matchs = $em->getRepository('AppBundle:Partie')->findAll();
        $completedMatchs = $this->getDoctrine()
            ->getRepository('AppBundle:Partie')
            ->findCompleted();

        $actualites = $this->getDoctrine()
            ->getRepository('AppBundle:Actualite')
            ->findThree();

        $medias = $this->getDoctrine()
            ->getRepository('AppBundle:Media')
            ->findNine();

        return $this->render('home/matches.html.twig', array(
            'matchs' => $matchs,
            'completedMatchs' => $completedMatchs,
            'actualites' => $actualites,
            'medias' => $medias,
        ));
    }

    /**
     *
     *
     * @Route("/singlematch/{id}", name="single_match")
     * @Method("GET")
     */
    public function singleMatchAction(Partie $match)
    {
        $actualites = $this->getDoctrine()
            ->getRepository('AppBundle:Actualite')
            ->findThree();
        $medias = $this->getDoctrine()
            ->getRepository('AppBundle:Media')
            ->findNine();

        return $this->render('home/single_match.html.twig', array(
            'match' => $match,
            'actualites' => $actualites,
            'medias' => $medias,
        ));
    }

    /**
     *
     *
     * @Route("/video/{id}", name="single_video")
     * @Method("GET")
     */
    public function videoAction(Media $media)
    {
        $actualites = $this->getDoctrine()
            ->getRepository('AppBundle:Actualite')
            ->findThree();
        $medias = $this->getDoctrine()
            ->getRepository('AppBundle:Media')
            ->findNine();
        $videos = $this->getDoctrine()
            ->getRepository('AppBundle:Media')->findSixVideos();

        return $this->render('home/video.html.twig', array(
            'media' => $media,
            'actualites' => $actualites,
            'medias' => $medias,
            'videos' => $videos,
        ));
    }

    public function chartHistogramme($data)
    {
        $series = array(
            array(
                'name' => 'Matchs',
                'type' => 'column',
                'color' => '#4572A7',
//                'yAxis' => 1,
                'data' => array_values($data),
            ),
            array(
                'name' => 'Matches',
                'type' => 'spline',
                'color' => '#AA4643',
                'data' => array_values($data),
            ),
        );
        $yData = array(
            array(
                'labels' => array(
                    'formatter' => new Expr('function () { return this.value }'),
                    'style' => array('color' => '#AA4643')
                ),
                'title' => array(
                    'text' => 'Matches',
                    'style' => array('color' => '#AA4643')
                ),
                'opposite' => true,
            ),
//            array(
//                'labels' => array(
//                    'formatter' => new Expr('function () { return this.value }'),
//                    'style' => array('color' => '#4572A7')
//                ),
//                'gridLineWidth' => 0,
//                'title' => array(
//                    'text' => 'Matches',
//                    'style' => array('color' => '#4572A7')
//                ),
//            ),
        );
        $categories = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        $ob = new Highchart();
        $ob->chart->renderTo('container'); // The #id of the div where to render the chart
        $ob->chart->type('column');
        $ob->title->text('Monthly Wins');
        $ob->xAxis->categories($categories);

        $ob->yAxis($yData);
        $ob->legend->enabled(false);
        $formatter = new Expr('function () {
            return this.x + ": <b>" + this.y + "</b> ";
        }');
        $ob->tooltip->formatter($formatter);
        $ob->series($series);
        return $ob;
    }

}
