<?php

namespace ContainerCkA6dzx;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getUsuarioParticularPutControllerService extends App_ShoppingList_Backend_ShoppingListBackendKernelTestDebugContainer
{
    /**
     * Gets the public 'App\ShoppingList\Backend\Controller\Usuario\UsuarioParticularPutController' shared autowired service.
     *
     * @return \App\ShoppingList\Backend\Controller\Usuario\UsuarioParticularPutController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'Controller'.\DIRECTORY_SEPARATOR.'Usuario'.\DIRECTORY_SEPARATOR.'UsuarioParticularPutController.php';

        return $container->services['App\\ShoppingList\\Backend\\Controller\\Usuario\\UsuarioParticularPutController'] = new \App\ShoppingList\Backend\Controller\Usuario\UsuarioParticularPutController(($container->privates['Eurega\\Shared\\Infrastructure\\Bus\\Command\\Tactician\\TacticianCommandBusWrite'] ?? $container->load('getTacticianCommandBusWriteService')));
    }
}
