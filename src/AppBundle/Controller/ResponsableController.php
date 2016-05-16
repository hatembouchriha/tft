<?php

namespace AppBundle\Controller;

use Swift_Message;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Responsable;
use AppBundle\Form\ResponsableType;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

/**
 * Responsable controller.
 *
 * @Route("/admin/responsable")
 */
class ResponsableController extends Controller
{
    /**
     * Lists all Responsable entities.
     *
     * @Route("/", name="responsable_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $responsables = $em->getRepository('AppBundle:Responsable')->findAll();

        return $this->render('responsable/index.html.twig', array(
            'responsables' => $responsables,
        ));
    }

    /**
     * Creates a new Responsable entity.
     *
     * @Route("/new", name="responsable_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $responsable = new Responsable();
        $form = $this->createForm('AppBundle\Form\ResponsableType', $responsable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $pass = $responsable->getPassword();
            $responsable->setEnabled(true);
            $responsable->setRoles(array());
            $responsable->addRole('ROLE_RESPONSABLE');
            $encodedPass = new BCryptPasswordEncoder(12);
            $responsable->setPassword($encodedPass->encodePassword($responsable->getPassword(),$responsable->getSalt()) );
            $em->persist($responsable);
            $em->flush();
            $message = Swift_Message::newInstance()
                ->setSubject('Coordonées nouveau compte tft')
                ->setFrom("testpidev@gmail.com")
                ->setTo($responsable->getEmail())
                ->setBody("Votre compte a été ajouté avec succés au site tft \nVos coordonées: \nUsername: "
                    .$responsable->getUsername()."\nMot de passe: ".$pass);
            $this->get('mailer')->send($message);

            return $this->redirectToRoute('responsable_index');
        }

        return $this->render('responsable/new.html.twig', array(
            'responsable' => $responsable,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Responsable entity.
     *
     * @Route("/show/{id}", name="responsable_show")
     * @Method("GET")
     */
    public function showAction(Responsable $responsable)
    {


        return $this->render('responsable/show.html.twig', array(
            'responsable' => $responsable,
        ));
    }

    /**
     * Displays a form to edit an existing Responsable entity.
     *
     * @Route("/{id}/edit", name="responsable_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Responsable $responsable)
    {

        $editForm = $this->createForm('AppBundle\Form\ResponsableType', $responsable);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $encodedPass = new BCryptPasswordEncoder(12);
            $responsable->setPassword($encodedPass->encodePassword($responsable->getPassword(),$responsable->getSalt()) );
            $em->persist($responsable);
            $em->flush();

            return $this->redirectToRoute('responsable_index');
        }

        return $this->render('responsable/edit.html.twig', array(
            'responsable' => $responsable,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Responsable entity.
     *
     * @Route("/{id}", name="responsable_delete")
     * @Method({"DELETE", "GET"})
     */
    public function deleteAction(Request $request, Responsable $responsable)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($responsable);
        $em->flush();
        return $this->redirectToRoute('responsable_index');
    }
}
