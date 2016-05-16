<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Stade;
use AppBundle\Form\StadeType;

/**
 * Stade controller.
 *
 * @Route("/admin/stade")
 */
class StadeController extends Controller
{
    /**
     * Lists all Stade entities.
     *
     * @Route("/", name="stade_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stades = $em->getRepository('AppBundle:Stade')->findAll();

        return $this->render('stade/index.html.twig', array(
            'stades' => $stades,
        ));
    }

    /**
     * Creates a new Stade entity.
     *
     * @Route("/new", name="stade_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $stade = new Stade();
        $form = $this->createForm('AppBundle\Form\StadeType', $stade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $stade->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $stadeDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/stades';
            $file->move($stadeDir, $fileName);
            $stade->setImage($fileName);
            $em->persist($stade);
            $em->flush();

            return $this->redirectToRoute('stade_index');
        }

        return $this->render('stade/new.html.twig', array(
            'stade' => $stade,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Stade entity.
     *
     * @Route("/show/{id}", name="stade_show")
     * @Method("GET")
     */
    public function showAction(Stade $stade)
    {
        return $this->render('stade/show.html.twig', array(
            'stade' => $stade,
        ));
    }

    /**
     * Displays a form to edit an existing Stade entity.
     *
     * @Route("/{id}/edit", name="stade_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Stade $stade)
    {
        $editForm = $this->createForm('AppBundle\Form\StadeType', $stade);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $stade->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $stadeDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/stades';
            $file->move($stadeDir, $fileName);
            $stade->setImage($fileName);
            $em->persist($stade);
            $em->flush();

            return $this->redirectToRoute('stade_index');
        }

        return $this->render('stade/edit.html.twig', array(
            'stade' => $stade,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Stade entity.
     *
     * @Route("/{id}", name="stade_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction(Request $request, Stade $stade)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($stade);
        $em->flush();
        return $this->redirectToRoute('stade_index');
    }
}
