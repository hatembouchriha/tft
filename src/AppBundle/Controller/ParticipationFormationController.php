<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Formation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ParticipationFormation;
use AppBundle\Form\ParticipationFormationType;

/**
 * ParticipationFormation controller.
 *
 * @Route("/arbitre/participationformation")
 */
class ParticipationFormationController extends Controller
{
    /**
     * Lists all ParticipationFormation entities.
     *
     * @Route("/", name="participationformation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $participationFormations = $em->getRepository('AppBundle:ParticipationFormation')->findAll();
        $formations = $em->getRepository('AppBundle:Formation')->findAll();
        return $this->render('participationformation/index.html.twig', array(
            'participationFormations' => $participationFormations,
            'formations' => $formations,
        ));
    }

    /**
     * Creates a new ParticipationFormation entity.
     *
     * @Route("/new/{id}", name="participationformation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Formation $formation)
    {
        $participationFormation = new ParticipationFormation();
        $em = $this->getDoctrine()->getManager();
        $participationFormation->setIdFormation($formation);
        $participationFormation->setEtat(false);
        $arbitre = $em->getRepository('AppBundle:Arbitre')->find(3);
        $participationFormation->setIdArbitre($arbitre);
        $em->persist($participationFormation);
        $em->flush();

        return $this->redirectToRoute('participationformation_index');

    }

    /**
     * Finds and displays a ParticipationFormation entity.
     *
     * @Route("/{id}", name="participationformation_show")
     * @Method("GET")
     */
    public function showAction(ParticipationFormation $participationFormation)
    {
        $deleteForm = $this->createDeleteForm($participationFormation);

        return $this->render('participationformation/show.html.twig', array(
            'participationFormation' => $participationFormation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ParticipationFormation entity.
     *
     * @Route("/{id}/edit", name="participationformation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ParticipationFormation $participationFormation)
    {
        $deleteForm = $this->createDeleteForm($participationFormation);
        $editForm = $this->createForm('AppBundle\Form\ParticipationFormationType', $participationFormation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($participationFormation);
            $em->flush();

            return $this->redirectToRoute('participationformation_edit', array('id' => $participationFormation->getId()));
        }

        return $this->render('participationformation/edit.html.twig', array(
            'participationFormation' => $participationFormation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ParticipationFormation entity.
     *
     * @Route("/{id}", name="participationformation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ParticipationFormation $participationFormation)
    {
        $form = $this->createDeleteForm($participationFormation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($participationFormation);
            $em->flush();
        }

        return $this->redirectToRoute('participationformation_index');
    }

    /**
     * Creates a form to delete a ParticipationFormation entity.
     *
     * @param ParticipationFormation $participationFormation The ParticipationFormation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ParticipationFormation $participationFormation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('participationformation_delete', array('id' => $participationFormation->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
