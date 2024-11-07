<?php

namespace ContainerYtaY3PI;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getFilesystemService extends App_ShoppingList_Backend_ShoppingListBackendKernelTestDebugContainer
{
    /**
     * Gets the private 'filesystem' shared service.
     *
     * @return \Symfony\Component\Filesystem\Filesystem
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['filesystem'] = new \Symfony\Component\Filesystem\Filesystem();
    }
}
