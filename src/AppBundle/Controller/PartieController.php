<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Partie;
use AppBundle\Form\PartieType;

/**
 * Partie controller.
 *
 * @Route("/admin/partie")
 */
class PartieController extends Controller
{
    /**
     * Lists all Partie entities.
     *
     * @Route("/", name="partie_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $parties = $em->getRepository('AppBundle:Partie')->findAll();

        return $this->render('partie/index.html.twig', array(
            'parties' => $parties,
        ));
    }

    /**
     * Creates a new Partie entity.
     *
     * @Route("/new", name="partie_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $partie = new Partie();
        $form = $this->createFormBuilder($partie)
            ->add('genre')
            ->add('score')
            ->add('dateMatch', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('lien')
            ->add('idJoueurUn')
            ->add('idJoueurDeux')
            ->add('idJoueurQuatre')
            ->add('idJoueurTrois')
            ->add('idEvenement')
            ->add('idArbitre')
            ->add('idStade')
            ->add('description', TextareaType::class)
            ->add('type')
            ->add('setUn')
            ->add('setDeux')
            ->add('setTrois')
            ->add('setQuatre')
            ->add('setCinq')
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partie);
            $em->flush();

            return $this->redirectToRoute('partie_index');
        }

        return $this->render('partie/new.html.twig', array(
            'partie' => $partie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Partie entity.
     *
     * @Route("/show/{id}", name="partie_show")
     * @Method("GET")
     */
    public function showAction(Partie $partie)
    {
        return $this->render('partie/show.html.twig', array(
            'partie' => $partie,
        ));
    }

    /**
     * Displays a form to edit an existing Partie entity.
     *
     * @Route("/{id}/edit", name="partie_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Partie $partie)
    {
        $editForm = $this->createForm('AppBundle\Form\PartieType', $partie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partie);
            $em->flush();

            return $this->redirectToRoute('partie_index');
        }

        return $this->render('partie/edit.html.twig', array(
            'partie' => $partie,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Partie entity.
     *
     * @Route("/{id}", name="partie_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction(Request $request, Partie $partie)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($partie);
        $em->flush();
        return $this->redirectToRoute('partie_index');
    }
}
