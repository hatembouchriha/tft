<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Invitation;
use AppBundle\Form\InvitationType;

/**
 * Invitation controller.
 *
 * @Route("/medecin/invitation")
 */
class InvitationController extends Controller
{
    /**
     * Lists all Invitation entities.
     *
     * @Route("/", name="invitation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invitations = $em->getRepository('AppBundle:Invitation')->findAll();

        return $this->render('invitation/index.html.twig', array(
            'invitations' => $invitations,
        ));
    }

    /**
     * Creates a new Invitation entity.
     *
     * @Route("/new", name="invitation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $invitation = new Invitation();
        $form = $this->createForm('AppBundle\Form\InvitationType', $invitation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $joueurs = $em->getRepository('AppBundle:Joueur')->findAll();
            $rand_key = array_rand($joueurs, 1);
            $invitation->setIdJoueur($joueurs[$rand_key]);
            $em->persist($invitation);
            $em->flush();

            return $this->redirectToRoute('invitation_index');
        }

        return $this->render('invitation/new.html.twig', array(
            'invitation' => $invitation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Invitation entity.
     *
     * @Route("/show/{id}", name="invitation_show")
     * @Method("GET")
     */
    public function showAction(Invitation $invitation)
    {
        return $this->render('invitation/show.html.twig', array(
            'invitation' => $invitation,
        ));
    }

    /**
     * Displays a form to edit an existing Invitation entity.
     *
     * @Route("/{id}/edit", name="invitation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Invitation $invitation)
    {
        $editForm = $this->createForm('AppBundle\Form\InvitationType', $invitation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invitation);
            $em->flush();

            return $this->redirectToRoute('invitation_index');
        }

        return $this->render('invitation/edit.html.twig', array(
            'invitation' => $invitation,
            'form' => $editForm->createView(),
        ));
    }
}
