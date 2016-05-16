<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Don;
use AppBundle\Form\DonType;

/**
 * Don controller.
 *
 * @Route("/admin/don")
 */
class DonController extends Controller
{
    /**
     * Lists all Don entities.
     *
     * @Route("/", name="don_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dons = $em->getRepository('AppBundle:Don')->findAll();

        return $this->render('don/index.html.twig', array(
            'dons' => $dons,
        ));
    }

    /**
     * Creates a new Don entity.
     *
     * @Route("/new", name="don_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $don = new Don();
        $form = $this->createFormBuilder($don)
            ->add('dateDon', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('description')
            ->add('idClub')
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($don);
            $em->flush();

            return $this->redirectToRoute('don_index');
        }

        return $this->render('don/new.html.twig', array(
            'don' => $don,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Don entity.
     *
     * @Route("/show/{id}", name="don_show")
     * @Method("GET")
     */
    public function showAction(Don $don)
    {
        return $this->render('don/show.html.twig', array(
            'don' => $don,
        ));
    }

    /**
     * Displays a form to edit an existing Don entity.
     *
     * @Route("/{id}/edit", name="don_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Don $don)
    {
        $editForm = $this->createForm('AppBundle\Form\DonType', $don);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($don);
            $em->flush();

            return $this->redirectToRoute('don_index');
        }

        return $this->render('don/edit.html.twig', array(
            'don' => $don,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Don entity.
     *
     * @Route("/{id}", name="don_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction(Request $request, Don $don)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($don);
        $em->flush();
        return $this->redirectToRoute('don_index');
    }
}
