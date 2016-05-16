<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Statistic;
use AppBundle\Form\StatisticType;

/**
 * Statistic controller.
 *
 * @Route("/admin/statistic")
 */
class StatisticController extends Controller
{
    /**
     * Lists all Statistic entities.
     *
     * @Route("/", name="statistic_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $statistics = $em->getRepository('AppBundle:Statistic')->findAll();

        return $this->render('statistic/index.html.twig', array(
            'statistics' => $statistics,
        ));
    }

    /**
     * Creates a new Statistic entity.
     *
     * @Route("/new", name="statistic_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $statistic = new Statistic();
        $form = $this->createForm('AppBundle\Form\StatisticType', $statistic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($statistic);
            $em->flush();

            return $this->redirectToRoute('statistic_index');
        }

        return $this->render('statistic/new.html.twig', array(
            'statistic' => $statistic,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Statistic entity.
     *
     * @Route("/show/{id}", name="statistic_show")
     * @Method("GET")
     */
    public function showAction(Statistic $statistic)
    {
        return $this->render('statistic/show.html.twig', array(
            'statistic' => $statistic,
        ));
    }

    /**
     * Displays a form to edit an existing Statistic entity.
     *
     * @Route("/{id}/edit", name="statistic_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Statistic $statistic)
    {
        $editForm = $this->createForm('AppBundle\Form\StatisticType', $statistic);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($statistic);
            $em->flush();

            return $this->redirectToRoute('statistic_index');
        }

        return $this->render('statistic/edit.html.twig', array(
            'statistic' => $statistic,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Statistic entity.
     *
     * @Route("/{id}", name="statistic_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction(Request $request, Statistic $statistic)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($statistic);
        $em->flush();
        return $this->redirectToRoute('statistic_index');
    }
}
