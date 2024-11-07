<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Symfony\Security\Authenticator;

use Eurega\Shared\Domain\Bus\Command\CommandBusWrite;
use Eurega\Shared\Domain\ValueObject\Security\ClearTextPassword;
use Eurega\Shared\Domain\ValueObject\Security\PasswordHash;

use Eurega\Shared\Infrastructure\Symfony\Security\Usuario\SfUsuario;
use Eurega\Shared\Infrastructure\Symfony\Security\Usuario\SfUsuarioAdministrador;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Throwable;

final class LoginAuthenticator extends AbstractLoginFormAuthenticator
{
    private const LOGIN_URL_ROUTE_NAME = 'backoffice_login';
    private const LOGIN_USUARIO_ADMINISTRADOR_REDIRECT_URL = 'ui_admin_listado_envios';

    // private const LOGIN_USUARIO_REGISTRADO_REDIRECT_URL = 'ui_proquimia_listado_envios';
    // private const LOGIN_USUARIO_SUPERADMIN_REDIRECT_URL = 'ui_superadmin_listado_administradores';
   

    public function __construct(
       private  RouterInterface $router,
       private  CommandBusWrite $commandBusWrite
    ) {
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->router->generate(self::LOGIN_URL_ROUTE_NAME);
    }

    public function supports(Request $request): bool
    {
        return $request->attributes->get('_route') === self::LOGIN_URL_ROUTE_NAME
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request): array
    {
        return [
            'username' => $request->request->get('_username'),
            'password' => $request->request->get('_password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];
    }

    public function authenticate(Request $request): Passport
    {
        $credentials = $this->getCredentials($request);
        // $textPassword = $credentials['password'];
        // try {
        //     $password = ClearTextPassword::fromString(
        //         $credentials['password']
        //     );

        //     return $password->matches(
        //         PasswordHash::fromHash($user->getPassword())
        //     );
        // } catch (Throwable $exception) {
        // // } catch (ClearTextPasswordIsNotValid $exception) {
        //     throw $exception;
        //     return false;
        // }
        
        return new Passport(new UserBadge($credentials['username']), new CustomCredentials(
            function(string $credentials, SfUsuario $user): bool  {
                
                $password = ClearTextPassword::fromString(
                    $credentials
                );
    
                return $password->matches(
                    PasswordHash::fromHash($user->getPassword())
                );
            },
            $credentials['password']
        ));
    }

    public function getUser(
        $credentials, 
        UserProviderInterface $userProvider
    ) {
        try {
            return $userProvider->loadUserByIdentifier($credentials['username']);
        } catch (Throwable $exception) {
            throw new AuthenticationException($exception->getMessage());
        }
    }

    public function onAuthenticationSuccess(
        Request $request,
        TokenInterface $token,
        string $providerKey
    ): RedirectResponse {
        
        $route = null;
        // $this->commandBusWrite->handle(
        //     new AccederUsuarioCommand($token->getUser()->getUserIdentifier())
        // );

        // Redirección en función de cada tipo de usuario
        if ($token->getUser() instanceof SfUsuarioAdministrador) {
            $route = self::LOGIN_USUARIO_ADMINISTRADOR_REDIRECT_URL;
        } 
        /*
        elseif ($token->getUser() instanceof SfUsuarioRegistrado) {
            $route = self::LOGIN_USUARIO_REGISTRADO_REDIRECT_URL;
        } elseif ($token->getUser() instanceof SfUsuarioTransportista) {
            $route = self::LOGIN_USUARIO_TRANSPORTISTA_REDIRECT_URL;
        } 
            */
        else {
            $route = self::LOGIN_URL_ROUTE_NAME;
        }

        return new RedirectResponse(
            $this->router->generate(
                $route
            )
        );
    }
}
