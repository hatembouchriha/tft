<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Actualite;
use AppBundle\Form\ActualiteType;

/**
 * Actualite controller.
 *
 * @Route("/admin/actualite")
 */
class ActualiteController extends Controller
{
    /**
     * Lists all Actualite entities.
     *
     * @Route("/", name="actualite_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $actualites = $em->getRepository('AppBundle:Actualite')->findAll();

        return $this->render('actualite/index.html.twig', array(
            'actualites' => $actualites,
        ));
    }

    /**
     * Creates a new Actualite entity.
     *
     * @Route("/new", name="actualite_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $actualite = new Actualite();
        $form = $this->createFormBuilder($actualite)
            ->add('titre')
            ->add('contenu')
            ->add('datePublication', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('image', FileType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $actualite->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $actualiteDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/actualites';
            $file->move($actualiteDir, $fileName);
            $actualite->setImage($fileName);
            $em->persist($actualite);
            $em->flush();

            return $this->redirectToRoute('actualite_index');
        }

        return $this->render('actualite/new.html.twig', array(
            'actualite' => $actualite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Actualite entity.
     *
     * @Route("/show/{id}", name="actualite_show")
     * @Method("GET")
     */
    public function showAction(Actualite $actualite)
    {


        return $this->render('actualite/show.html.twig', array(
            'actualite' => $actualite,
        ));
    }

    /**
     * Displays a form to edit an existing Actualite entity.
     *
     * @Route("/{id}/edit", name="actualite_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Actualite $actualite)
    {

        $editForm = $this->createForm('AppBundle\Form\ActualiteType', $actualite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $actualite->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $actualiteDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/actualites';
            $file->move($actualiteDir, $fileName);
            $actualite->setImage($fileName);
            $em->persist($actualite);
            $em->flush();

            return $this->redirectToRoute('actualite_index', array('id' => $actualite->getId()));
        }

        return $this->render('actualite/edit.html.twig', array(
            'actualite' => $actualite,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Actualite entity.
     *
     * @Route("/{id}", name="actualite_delete")
     * @Method({"DELETE", "GET"})
     */
    public function deleteAction(Request $request, Actualite $actualite)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($actualite);
        $em->flush();
        return $this->redirectToRoute('actualite_index');
    }

}
