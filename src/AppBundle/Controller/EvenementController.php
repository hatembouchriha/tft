<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Evenement;
use AppBundle\Form\EvenementType;

/**
 * Evenement controller.
 *
 * @Route("/admin/evenement")
 */
class EvenementController extends Controller
{
    /**
     * Lists all Evenement entities.
     *
     * @Route("/", name="evenement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('AppBundle:Evenement')->findAll();

        return $this->render('evenement/index.html.twig', array(
            'evenements' => $evenements,
        ));
    }

    /**
     * Creates a new Evenement entity.
     *
     * @Route("/new", name="evenement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $evenement = new Evenement();
        $form = $this->createFormBuilder($evenement)
            ->add('nom')
            ->add('description')
            ->add('dateDebut',DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ))
            ->add('dateFin',DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ))
            ->add('prix')
            ->add('gagnant')
            ->add('image', FileType::class)
            ->getForm()
        ;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $evenement->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $evenementDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/evenements';
            $file->move($evenementDir, $fileName);
            $evenement->setImage($fileName);
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('evenement/new.html.twig', array(
            'evenement' => $evenement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Evenement entity.
     *
     * @Route("/show/{id}", name="evenement_show")
     * @Method("GET")
     */
    public function showAction(Evenement $evenement)
    {

        return $this->render('evenement/show.html.twig', array(
            'evenement' => $evenement,
        ));
    }

    /**
     * Displays a form to edit an existing Evenement entity.
     *
     * @Route("/{id}/edit", name="evenement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Evenement $evenement)
    {
        $editForm = $this->createForm('AppBundle\Form\EvenementType', $evenement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $evenement->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $evenementDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/evenements';
            $file->move($evenementDir, $fileName);
            $evenement->setImage($fileName);
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('evenement/edit.html.twig', array(
            'evenement' => $evenement,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Evenement entity.
     *
     * @Route("/{id}", name="evenement_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction(Request $request, Evenement $evenement)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($evenement);
        $em->flush();
        return $this->redirectToRoute('evenement_index');
    }

}
