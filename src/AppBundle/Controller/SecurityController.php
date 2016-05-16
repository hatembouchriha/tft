<?php
/**
 * Created by PhpStorm.
 * User: Bouchriha
 * Date: 16/04/2016
 * Time: 21:22
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityController extends BaseController
{
    public function loginAction(Request $request)
    {

        $authChecker = $this->container->get('security.authorization_checker');
        $router = $this->container->get('router');

        if ($authChecker->isGranted('ROLE_ADMIN')) {
            return new RedirectResponse($router->generate('actualite_index'), 307);
        }

        if ($authChecker->isGranted('ROLE_ARBITRE')) {
            return new RedirectResponse($router->generate('compterendumatch_index'), 307);
        }
        if ($authChecker->isGranted('ROLE_FAN')) {
            return new RedirectResponse($router->generate('site_login'), 307);
        }

        if ($authChecker->isGranted('ROLE_JOUEUR')) {
            return new RedirectResponse($router->generate('site_login'), 307);
        }
        if ($authChecker->isGranted('ROLE_MEDECIN')) {
            return new RedirectResponse($router->generate('compterendutest_index'), 307);
        }

        if ($authChecker->isGranted('ROLE_RESPONSABLE')) {
            return new RedirectResponse($router->generate('compterendutest_indexresponsable'), 307);
        }
        $actualites = $this->getDoctrine()
            ->getRepository('AppBundle:Actualite')
            ->findThree();

        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        if (class_exists('\Symfony\Component\Security\Core\Security')) {
            $authErrorKey = Security::AUTHENTICATION_ERROR;
            $lastUsernameKey = Security::LAST_USERNAME;
        } else {
            // BC for SF < 2.6
            $authErrorKey = SecurityContextInterface::AUTHENTICATION_ERROR;
            $lastUsernameKey = SecurityContextInterface::LAST_USERNAME;
        }

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        if ($this->has('security.csrf.token_manager')) {
            $csrfToken = $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue();
        } else {
            // BC for SF < 2.4
            $csrfToken = $this->has('form.csrf_provider')
                ? $this->get('form.csrf_provider')->generateCsrfToken('authenticate')
                : null;
        }

        return $this->renderLogin(array(
            'actualites' => $actualites,
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
        ));
    }
    public function logoutAction()
    {
        return $this->redirectToRoute('site_home');
    }
}