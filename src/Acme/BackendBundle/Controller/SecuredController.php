<?php

namespace Acme\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/unvadmin")
 */
class SecuredController extends Controller
{
    /**
     * @Route("/login", name="_login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('AcmeBackendBundle:Default:login.html.twig', array(
            'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    /**
     * @Route("/login_check", name="_security_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
        /*$username = trim($this->getRequest()->query->get('username'));
        $password = trim($this->getRequest()->query->get('password'));

        $em = $this->getDoctrine()->getManager();
        $user = $em->createQuery("SELECT u FROM @AcmeBackendBundle:Member m WHERE u.email = :email AND boolIsValid = true")
            ->setParameter('email', $username)
            ->getSingleScalarResult();



        if ($user) {
            // Get the encoder for the users password
            $encoder_service = $this->get('security.encoder_factory');
            $encoder = $encoder_service->getEncoder($user);
            $encoded_pass = $encoder->encodePassword($password, $user->getSalt());

            if ($user->getPassword() == $encoded_pass) {
                return true;
            } else {
                // Password bad
                return array(
                    'error'=>'用户未通过审核或密码不正确'
                );
            }
        } else {
            // Username bad
            return array(
                'error'=>'用户未通过审核或密码不正确'
            );
        }*/
    }

    /**
     * @Route("/logout", name="_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/hello", defaults={"name"="World"}),
     * @Route("/hello/{name}", name="_demo_secured_hello")
     * @Template()
     */
    public function helloAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/hello/admin/{name}", name="_demo_secured_hello_admin")
     * @Template()
     */
    public function helloadminAction($name)
    {
        return array('name' => $name);
    }


}
