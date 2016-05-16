<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Media;
use AppBundle\Form\MediaType;

/**
 * Media controller.
 *
 * @Route("/admin/media")
 */
class MediaController extends Controller
{
    /**
     * Lists all Media entities.
     *
     * @Route("/", name="media_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $media = $em->getRepository('AppBundle:Media')->findAll();

        return $this->render('media/index.html.twig', array(
            'media' => $media,
        ));
    }

    /**
     * Creates a new Media entity.
     *
     * @Route("/new", name="media_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $medium = new Media();
        $form = $this->createForm('AppBundle\Form\MediaType', $medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medium);
            $em->flush();

            return $this->redirectToRoute('media_index');
        }

        return $this->render('media/new.html.twig', array(
            'medium' => $medium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Media entity.
     *
     * @Route("/show/{id}", name="media_show")
     * @Method("GET")
     */
    public function showAction(Media $medium)
    {

        return $this->render('media/show.html.twig', array(
            'medium' => $medium,
        ));
    }

    /**
     * Displays a form to edit an existing Media entity.
     *
     * @Route("/{id}/edit", name="media_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Media $medium)
    {
        $editForm = $this->createForm('AppBundle\Form\MediaType', $medium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medium);
            $em->flush();

            return $this->redirectToRoute('media_index');
        }

        return $this->render('media/edit.html.twig', array(
            'medium' => $medium,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Media entity.
     *
     * @Route("/{id}", name="media_delete")
     * @Method({"GET","DELETE"})
     */
    public function deleteAction(Request $request, Media $medium)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($medium);
        $em->flush();
        return $this->redirectToRoute('media_index');
    }
}
