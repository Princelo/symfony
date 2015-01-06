<?php
namespace Acme\CustomerBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

use Acme\CoreBundle\Model\InitializableControllerInterface;

/**
 * @author Matt Drollette <matt@drollette.com>
 */
class CustomerController implements InitializableControllerInterface
{
    private $user;
    private $company;

    public function initialize(Request $request, SecurityContextInterface $security_context)
    {
        $this->user = $security_context->getToken()->getUser();
        echo date('w');exit;
    }

    // ... rest of controller actions
}