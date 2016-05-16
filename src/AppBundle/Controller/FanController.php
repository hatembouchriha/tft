<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Fan;
use AppBundle\Form\FanType;

/**
 * Fan controller.
 *
 * @Route("/admin/fan")
 */
class FanController extends Controller
{
    /**
     * Lists all Fan entities.
     *
     * @Route("/", name="fan_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fans = $em->getRepository('AppBundle:Fan')->findAll();

        return $this->render('fan/index.html.twig', array(
            'fans' => $fans,
        ));
    }

    /**
     * Creates a new Fan entity.
     *
     * @Route("/new", name="fan_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fan = new Fan();
        $form = $this->createForm('AppBundle\Form\FanType', $fan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fan);
            $em->flush();

            return $this->redirectToRoute('fan_index');
        }

        return $this->render('fan/new.html.twig', array(
            'fan' => $fan,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Fan entity.
     *
     * @Route("/show/{id}", name="fan_show")
     * @Method("GET")
     */
    public function showAction(Fan $fan)
    {

        return $this->render('fan/show.html.twig', array(
            'fan' => $fan,
        ));
    }

    /**
     * Displays a form to edit an existing Fan entity.
     *
     * @Route("/{id}/edit", name="fan_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Fan $fan)
    {
        $deleteForm = $this->createDeleteForm($fan);
        $editForm = $this->createForm('AppBundle\Form\FanType', $fan);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fan);
            $em->flush();

            return $this->redirectToRoute('fan_index');
        }

        return $this->render('fan/edit.html.twig', array(
            'fan' => $fan,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Fan entity.
     *
     * @Route("/{id}", name="fan_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Fan $fan)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($fan);
        $em->flush();

        return $this->redirectToRoute('fan_index');
    }
}
