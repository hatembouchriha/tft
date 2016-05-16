<?php

namespace AppBundle\Controller;

use Swift_Message;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Medecin;
use AppBundle\Form\MedecinType;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

/**
 * Medecin controller.
 *
 * @Route("/admin/medecin")
 */
class MedecinController extends Controller
{
    /**
     * Lists all Medecin entities.
     *
     * @Route("/", name="medecin_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $medecins = $em->getRepository('AppBundle:Medecin')->findAll();

        return $this->render('medecin/index.html.twig', array(
            'medecins' => $medecins,
        ));
    }

    /**
     * Creates a new Medecin entity.
     *
     * @Route("/new", name="medecin_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $medecin = new Medecin();
        $form = $this->createForm('AppBundle\Form\MedecinType', $medecin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $pass = $medecin->getPassword();
            $file = $medecin->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $medecinDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/medecins';
            $file->move($medecinDir, $fileName);
            $medecin->setImage($fileName);
            $medecin->setEnabled(true);
            $medecin->setRoles(array());
            $medecin->addRole('ROLE_MEDECIN');
            $encodedPass = new BCryptPasswordEncoder(12);
            $medecin->setPassword($encodedPass->encodePassword($medecin->getPassword(),$medecin->getSalt()) );
            $em->persist($medecin);
            $em->flush();
            $message = Swift_Message::newInstance()
                ->setSubject('Coordonées nouveau compte tft')
                ->setFrom("testpidev@gmail.com")
                ->setTo($medecin->getEmail())
                ->setBody("Votre compte a été ajouté avec succés au site tft \nVos coordonées: \nUsername: "
                    .$medecin->getUsername()."\nMot de passe: ".$pass);
            $this->get('mailer')->send($message);

            return $this->redirectToRoute('medecin_index');
        }

        return $this->render('medecin/new.html.twig', array(
            'medecin' => $medecin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Medecin entity.
     *
     * @Route("/show/{id}", name="medecin_show")
     * @Method("GET")
     */
    public function showAction(Medecin $medecin)
    {

        return $this->render('medecin/show.html.twig', array(
            'medecin' => $medecin,
        ));
    }

    /**
     * Displays a form to edit an existing Medecin entity.
     *
     * @Route("/{id}/edit", name="medecin_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Medecin $medecin)
    {
        $editForm = $this->createForm('AppBundle\Form\MedecinType', $medecin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $medecin->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $medecinDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/medecins';
            $file->move($medecinDir, $fileName);
            $medecin->setImage($fileName);
            $encodedPass = new BCryptPasswordEncoder(12);
            $medecin->setPassword($encodedPass->encodePassword($medecin->getPassword(),$medecin->getSalt()) );
            $em->persist($medecin);
            $em->flush();

            return $this->redirectToRoute('medecin_index');
        }

        return $this->render('medecin/edit.html.twig', array(
            'medecin' => $medecin,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Medecin entity.
     *
     * @Route("/{id}", name="medecin_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction(Request $request, Medecin $medecin)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($medecin);
        $em->flush();
        return $this->redirectToRoute('medecin_index');
    }
}
