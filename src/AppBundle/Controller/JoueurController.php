<?php

namespace AppBundle\Controller;

use Swift_Message;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Joueur;
use AppBundle\Entity\JoueurRepository;
use AppBundle\Form\JoueurType;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

/**
 * Joueur controller.
 *
 * @Route("/admin/joueur")
 */
class JoueurController extends Controller
{
    /**
     * Lists all Joueur entities.
     *
     * @Route("/", name="joueur_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $joueurs = $em->getRepository('AppBundle:Joueur')->findAll();

        return $this->render('joueur/index.html.twig', array(
            'joueurs' => $joueurs,
        ));
    }

    /**
     * Creates a new Joueur entity.
     *
     * @Route("/new", name="joueur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $joueur = new Joueur();
        $form = $this->createFormBuilder($joueur)
            ->add('nom')
            ->add('prenom')
            ->add('username')
            ->add('email')
            ->add('password', PasswordType::class)
            ->add('dateNaissance', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('taille')
            ->add('poids')
            ->add('score')
            ->add('categorie')
            ->add('groupeAge')
            ->add('image', FileType::class)
            ->add('nationalite')
            ->add('logoPays', FileType::class)
            ->add('idClub')
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $pass = $joueur->getPassword();
            $file = $joueur->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $joueurDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/joueurs';
            $file->move($joueurDir, $fileName);
            $joueur->setImage($fileName);
            $file = $joueur->getLogoPays();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $joueurDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/logoPays';
            $file->move($joueurDir, $fileName);
            $joueur->setLogoPays($fileName);
            $joueur->setEnabled(true);
            $joueur->setRoles(array());
            $joueur->addRole('ROLE_JOUEUR');
            $encodedPass = new BCryptPasswordEncoder(12);
            $joueur->setPassword($encodedPass->encodePassword($joueur->getPassword(),$joueur->getSalt()) );
            $em->persist($joueur);
            $em->flush();
            $message = Swift_Message::newInstance()
                ->setSubject('Coordonées nouveau compte tft')
                ->setFrom("testpidev@gmail.com")
                ->setTo($joueur->getEmail())
                ->setBody("Votre compte a été ajouté avec succés au site tft \nVos coordonées: \nUsername: "
                    .$joueur->getUsername()."\nMot de passe: ".$pass);
            $this->get('mailer')->send($message);

            return $this->redirectToRoute('joueur_index');
        }

        return $this->render('joueur/new.html.twig', array(
            'joueur' => $joueur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Joueur entity.
     *
     * @Route("/show/{id}", name="joueur_show")
     * @Method("GET")
     */
    public function showAction(Joueur $joueur)
    {
        return $this->render('joueur/show.html.twig', array(
            'joueur' => $joueur,
        ));
    }

    /**
     * Displays a form to edit an existing Joueur entity.
     *
     * @Route("/{id}/edit", name="joueur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Joueur $joueur)
    {
        $editForm = $this->createForm('AppBundle\Form\JoueurType', $joueur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $joueur->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $joueurDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/joueurs';
            $file->move($joueurDir, $fileName);
            $joueur->setImage($fileName);
            $file = $joueur->getLogoPays();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $joueurDir = $this->container->getParameter('kernel.root_dir').'/../../resources/images/logoPays';
            $file->move($joueurDir, $fileName);
            $joueur->setLogoPays($fileName);
            $encodedPass = new BCryptPasswordEncoder(12);
            $joueur->setPassword($encodedPass->encodePassword($joueur->getPassword(),$joueur->getSalt()) );
            $em->persist($joueur);
            $em->persist($joueur);
            $em->flush();

            return $this->redirectToRoute('joueur_index');
        }

        return $this->render('joueur/edit.html.twig', array(
            'joueur' => $joueur,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Joueur entity.
     *
     * @Route("/{id}", name="joueur_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction(Request $request, Joueur $joueur)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($joueur);
        $em->flush();
        return $this->redirectToRoute('joueur_index');
    }
}
