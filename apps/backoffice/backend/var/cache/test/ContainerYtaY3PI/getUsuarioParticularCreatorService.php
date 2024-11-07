<?php

namespace ContainerYtaY3PI;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getUsuarioParticularCreatorService extends App_ShoppingList_Backend_ShoppingListBackendKernelTestDebugContainer
{
    /**
     * Gets the private 'Eurega\ShoppingList\Application\Service\Usuario\UsuarioParticularCreator' shared autowired service.
     *
     * @return \Eurega\ShoppingList\Application\Service\Usuario\UsuarioParticularCreator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['Eurega\\ShoppingList\\Application\\Service\\Usuario\\UsuarioParticularCreator'] = new \Eurega\ShoppingList\Application\Service\Usuario\UsuarioParticularCreator(($container->privates['Tests\\Shared\\Infrastructure\\Repository\\MysqlUsuarioParticularWriteRepository'] ??= new \Tests\Shared\Infrastructure\Repository\MysqlUsuarioParticularWriteRepository()), ($container->privates['Tests\\Shared\\Infrastructure\\Repository\\UsuarioParticularReadRepository'] ??= new \Tests\Shared\Infrastructure\Repository\UsuarioParticularReadRepository()), ($container->privates['Eurega\\Shared\\Infrastructure\\Bus\\Event\\InMemory\\InMemorySymfonyEventBus'] ??= new \Eurega\Shared\Infrastructure\Bus\Event\InMemory\InMemorySymfonyEventBus()));
    }
}
