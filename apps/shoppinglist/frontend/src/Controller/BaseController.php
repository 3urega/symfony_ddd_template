<?php

declare(strict_types=1);

namespace App\ShoppingList\Frontend\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

final class BaseController extends AbstractController {

    public function __construct(
        private EntityManagerInterface $em,
        private Environment $twig,
        private RouterInterface $router
    ) { }

    public function __invoke() {

        $this->em->getConnection()->connect();
        $connected = $this->em->getConnection()->isConnected();

        return new Response(
            $this->twig->render(
                '/shoppinglist/frontend/templates/base.html.twig'
            )
        );
    }
    /*

    $route = 'ui_backoffice_usuario_login';

        if ($this->getUser() instanceof SfUsuarioSuperadmin) {
            $route = 'ui_superadmin_listado_administradores';
        } elseif ($this->getUser() instanceof SfUsuarioAdministrador) {
            $route = 'ui_admin_listado_envios';
        } elseif ($this->getUser() instanceof SfUsuarioRegistrado) {
            $route = 'ui_proquimia_listado_envios';
        } elseif ($this->getUser() instanceof SfUsuarioTransportista) {
            $route = 'ui_transportista_listado_envios';
        }

        return new RedirectResponse(
            $this->router->generate(
                $route
            )
        );
        
    */
}