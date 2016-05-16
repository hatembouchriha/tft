<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CompteRenduMatch;
use AppBundle\Form\CompteRenduMatchType;

/**
 * CompteRenduMatch controller.
 *
 * @Route("/arbitre/compterendumatch")
 */
class CompteRenduMatchController extends Controller
{
    /**
     * Lists all CompteRenduMatch entities.
     *
     * @Route("/", name="compterendumatch_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $compteRenduMatches = $em->getRepository('AppBundle:CompteRenduMatch')->findAll();

        return $this->render('compterendumatch/index.html.twig', array(
            'compteRenduMatches' => $compteRenduMatches,
        ));
    }

    /**
     * Creates a new CompteRenduMatch entity.
     *
     * @Route("/new", name="compterendumatch_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $compteRenduMatch = new CompteRenduMatch();
        $form = $this->createForm('AppBundle\Form\CompteRenduMatchType', $compteRenduMatch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($compteRenduMatch);
            $em->flush();

            return $this->redirectToRoute('compterendumatch_index');
        }

        return $this->render('compterendumatch/new.html.twig', array(
            'compteRenduMatch' => $compteRenduMatch,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CompteRenduMatch entity.
     *
     * @Route("/{id}", name="compterendumatch_show")
     * @Method("GET")
     */
    public function showAction(CompteRenduMatch $compteRenduMatch)
    {
        return $this->render('compterendumatch/show.html.twig', array(
            'compteRenduMatch' => $compteRenduMatch,
        ));
    }

    /**
     * Displays a form to edit an existing CompteRenduMatch entity.
     *
     * @Route("/{id}/edit", name="compterendumatch_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CompteRenduMatch $compteRenduMatch)
    {
        $editForm = $this->createForm('AppBundle\Form\CompteRenduMatchType', $compteRenduMatch);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($compteRenduMatch);
            $em->flush();

            return $this->redirectToRoute('compterendumatch_index');
        }

        return $this->render('compterendumatch/edit.html.twig', array(
            'compteRenduMatch' => $compteRenduMatch,
            'form' => $editForm->createView(),
        ));
    }
}
