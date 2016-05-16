<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Formation;
use AppBundle\Form\FormationType;

/**
 * Formation controller.
 *
 * @Route("/admin/formation")
 */
class FormationController extends Controller
{
    /**
     * Lists all Formation entities.
     *
     * @Route("/", name="formation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formations = $em->getRepository('AppBundle:Formation')->findAll();

        return $this->render('formation/index.html.twig', array(
            'formations' => $formations,
        ));
    }

    /**
     * Creates a new Formation entity.
     *
     * @Route("/new", name="formation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $formation = new Formation();
        $form = $this->createFormBuilder($formation)
            ->add('dateDebut', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('dateFin', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('description')
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();

            return $this->redirectToRoute('formation_index');
        }

        return $this->render('formation/new.html.twig', array(
            'formation' => $formation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Formation entity.
     *
     * @Route("/show/{id}", name="formation_show")
     * @Method("GET")
     */
    public function showAction(Formation $formation)
    {
        return $this->render('formation/show.html.twig', array(
            'formation' => $formation,
        ));
    }

    /**
     * Displays a form to edit an existing Formation entity.
     *
     * @Route("/{id}/edit", name="formation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Formation $formation)
    {
        $editForm = $this->createForm('AppBundle\Form\FormationType', $formation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();

            return $this->redirectToRoute('formation_index');
        }

        return $this->render('formation/edit.html.twig', array(
            'formation' => $formation,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Formation entity.
     *
     * @Route("/{id}", name="formation_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction(Request $request, Formation $formation)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($formation);
        $em->flush();
        return $this->redirectToRoute('formation_index');
    }
}
