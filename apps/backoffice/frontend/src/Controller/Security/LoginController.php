<?php

namespace App\Backoffice\Frontend\Controller\Security;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

final class LoginController
{
    public function __construct(
        private Environment $twigEnvironment
    )
    {
        
    }
    public function __invoke(AuthenticationUtils $authenticationUtils): Response
    {
        return new Response(
            $this->twigEnvironment->render(
                '@backoffice/security/login.twig',
                [
                    'error' => $authenticationUtils->getLastAuthenticationError(),
                    'last_username' => $authenticationUtils->getLastUsername(),
                ]
            )
        );
    }
}
