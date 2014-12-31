<?php
namespace Acme\BackendBundle\Handler;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthenticationHandler extends ContainerAware implements AuthenticationSuccessHandlerInterface
{
    function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $token->getUser()->setTimeLastLoginTime(new \DateTime());
        $this->container->get('doctrine')->getEntityManager()->flush();

        return new RedirectResponse($this->container->get('router')->generate('_unvadmin_index'));
    }
}