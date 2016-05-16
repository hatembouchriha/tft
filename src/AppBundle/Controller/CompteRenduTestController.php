<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CompteRenduTest;
use AppBundle\Form\CompteRenduTestType;

/**
 * CompteRenduTest controller.
 *
 * @Route("/")
 */
class CompteRenduTestController extends Controller
{
    /**
     * Lists all CompteRenduTest entities.
     *
     * @Route("/medecin/compterendutest", name="compterendutest_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $compteRenduTests = $em->getRepository('AppBundle:CompteRenduTest')->findAll();

        return $this->render('compterendutest/index.html.twig', array(
            'compteRenduTests' => $compteRenduTests,
        ));
    }

    /**
     * Creates a new CompteRenduTest entity.
     *
     * @Route("/medecin/compterendutest/new", name="compterendutest_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $compteRenduTest = new CompteRenduTest();
        $form = $this->createForm('AppBundle\Form\CompteRenduTestType', $compteRenduTest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $compteRenduTest->setEtat(false);
            $responsables = $em->getRepository('AppBundle:Responsable')->findAll();
            $rand_key = array_rand($responsables, 1);
            $compteRenduTest->setIdResponsable($responsables[$rand_key]);
            $em->persist($compteRenduTest);
            $em->flush();

            return $this->redirectToRoute('compterendutest_index');
        }

        return $this->render('compterendutest/new.html.twig', array(
            'compteRenduTest' => $compteRenduTest,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CompteRenduTest entity.
     *
     * @Route("/medecin/show/{id}", name="compterendutest_show")
     * @Method("GET")
     */
    public function showAction(CompteRenduTest $compteRenduTest)
    {

        return $this->render('compterendutest/show.html.twig', array(
            'compteRenduTest' => $compteRenduTest,
        ));
    }

    /**
     * Displays a form to edit an existing CompteRenduTest entity.
     *
     * @Route("/medecin/{id}/edit", name="compterendutest_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CompteRenduTest $compteRenduTest)
    {
        $editForm = $this->createForm('AppBundle\Form\CompteRenduTestType', $compteRenduTest);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($compteRenduTest);
            $em->flush();

            return $this->redirectToRoute('compterendutest_index');
        }

        return $this->render('compterendutest/edit.html.twig', array(
            'compteRenduTest' => $compteRenduTest,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Lists all CompteRenduTest entities.
     *
     * @Route("/responsable/index", name="compterendutest_indexresponsable")
     * @Method("GET")
     */
    public function indexResponsableAction()
    {
        $em = $this->getDoctrine()->getManager();

        $compteRenduTests = $em->getRepository('AppBundle:CompteRenduTest')->findByIdResponsable($this->getUser());

        return $this->render('compterendutest/indexresponsable.html.twig', array(
            'compteRenduTests' => $compteRenduTests,
        ));
    }

    /**
     * Displays a form to edit an existing CompteRenduTest entity.
     *
     * @Route("/responsable/{id}/share", name="compterendutest_share")
     * @Method({"GET", "POST"})
     */
    public function shareAction(Request $request, CompteRenduTest $compteRenduTest)
    {
        $em = $this->getDoctrine()->getManager();
        $compteRenduTest->setEtat(true);
        $em->persist($compteRenduTest);
        $em->flush();

        return $this->redirectToRoute('compterendutest_indexresponsable');
    }
}
