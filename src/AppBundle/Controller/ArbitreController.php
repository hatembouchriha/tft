<?php

namespace AppBundle\Controller;

use Swift_Message;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Arbitre;
use AppBundle\Form\ArbitreType;

/**
 * Arbitre controller.
 *
 * @Route("/admin/arbitre")
 */
class ArbitreController extends Controller
{
    /**
     * Lists all Arbitre entities.
     *
     * @Route("/", name="arbitre_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $arbitres = $em->getRepository('AppBundle:Arbitre')->findAll();

        return $this->render('arbitre/index.html.twig', array(
            'arbitres' => $arbitres,
        ));
    }

    /**
     * Creates a new Arbitre entity.
     *
     * @Route("/new", name="arbitre_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $arbitre = new Arbitre();
        $form = $this->createFormBuilder($arbitre)
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('username')
            ->add('password', PasswordType::class)
            ->add('categorie')
            ->add('dateNaissance', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('image', FileType::class)
            ->getForm();
        $form->handleRequest($request);
//        $this->container
//            ->get('pugx_multi_user.registration_manager')
//            ->register('AppBundle\Entity\Arbitre');

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $pass = $arbitre->getPassword();
            $file = $arbitre->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $arbitreDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/arbitres';
            $file->move($arbitreDir, $fileName);
            $encodedPass = new BCryptPasswordEncoder(12);
            $arbitre->setPassword($encodedPass->encodePassword($arbitre->getPassword(),$arbitre->getSalt()) );
            $arbitre->setImage($fileName);
            $arbitre->setEnabled(true);
            $arbitre->setRoles(array());
            $arbitre->addRole('ROLE_ARBITRE');
            $em->persist($arbitre);
            $em->flush();
            $message = \Swift_Message::newInstance()
                    ->setSubject('Coordonées nouveau compte tft')
                    ->setFrom("testpidev@gmail.com")
                    ->setTo($arbitre->getEmail())
                    ->setBody("Votre compte a été ajouté avec succés au site tft \nVos coordonées: \nUsername: "
                        .$arbitre->getUsername()."\nMot de passe: ".$pass);
            $this->get('mailer')->send($message);

            return $this->redirectToRoute('arbitre_index');
        }

        return $this->render('arbitre/new.html.twig', array(
            'arbitre' => $arbitre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Arbitre entity.
     *
     * @Route("/show/{id}", name="arbitre_show")
     * @Method("GET")
     */
    public function showAction(Arbitre $arbitre)
    {
        return $this->render('arbitre/show.html.twig', array(
            'arbitre' => $arbitre,
        ));
    }

    /**
     * Displays a form to edit an existing Arbitre entity.
     *
     * @Route("/{id}/edit", name="arbitre_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Arbitre $arbitre)
    {
        $editForm = $this->createForm('AppBundle\Form\ArbitreType', $arbitre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $encodedPass = new BCryptPasswordEncoder(12);
            $arbitre->setPassword($encodedPass->encodePassword($arbitre->getPassword(),$arbitre->getSalt()) );
            $file = $arbitre->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $arbitreDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/arbitres';
            $file->move($arbitreDir, $fileName);
            $arbitre->setImage($fileName);
            $em->persist($arbitre);
            $em->flush();

            return $this->redirectToRoute('arbitre_index');
        }

        return $this->render('arbitre/edit.html.twig', array(
            'arbitre' => $arbitre,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Arbitre entity.
     *
     * @Route("/{id}", name="arbitre_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction(Request $request, Arbitre $arbitre)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($arbitre);
        $em->flush();

        return $this->redirectToRoute('arbitre_index');
    }
}
