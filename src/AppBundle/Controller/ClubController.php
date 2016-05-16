<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Club;
use AppBundle\Form\ClubType;

/**
 * Club controller.
 *
 * @Route("/admin/club")
 */
class ClubController extends Controller
{
    /**
     * Lists all Club entities.
     *
     * @Route("/", name="club_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clubs = $em->getRepository('AppBundle:Club')->findAll();

        return $this->render('club/index.html.twig', array(
            'clubs' => $clubs,
        ));
    }

    /**
     * Creates a new Club entity.
     *
     * @Route("/new", name="club_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $club = new Club();
        $form = $this->createFormBuilder($club)
            ->add('nom')
            ->add('adresse')
            ->add('dateFondation', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('logo', FileType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $club->getLogo();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $clubDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/clubs';
            $file->move($clubDir, $fileName);
            $club->setLogo($fileName);
            $em->persist($club);
            $em->flush();

            return $this->redirectToRoute('club_index');
        }

        return $this->render('club/new.html.twig', array(
            'club' => $club,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Club entity.
     *
     * @Route("/show/{id}", name="club_show")
     * @Method("GET")
     */
    public function showAction(Club $club)
    {

        return $this->render('club/show.html.twig', array(
            'club' => $club,
        ));
    }

    /**
     * Displays a form to edit an existing Club entity.
     *
     * @Route("/{id}/edit", name="club_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Club $club)
    {
        $editForm = $this->createForm('AppBundle\Form\ClubType', $club);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $club->getLogo();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $clubDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/clubs';
            $file->move($clubDir, $fileName);
            $club->setLogo($fileName);
            $em->persist($club);
            $em->flush();

            return $this->redirectToRoute('club_index');
        }

        return $this->render('club/edit.html.twig', array(
            'club' => $club,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Club entity.
     *
     * @Route("/{id}", name="club_delete")
     * @Method({"GET","DELETE"})
     */
    public function deleteAction(Request $request, Club $club)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($club);
        $em->flush();

        return $this->redirectToRoute('club_index');
    }
}
