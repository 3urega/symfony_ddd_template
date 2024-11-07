<?php

namespace ContainerYtaY3PI;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getChatter_TransportFactoryService extends App_ShoppingList_Backend_ShoppingListBackendKernelTestDebugContainer
{
    /**
     * Gets the private 'chatter.transport_factory' shared service.
     *
     * @return \Symfony\Component\Notifier\Transport
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['chatter.transport_factory'] = new \Symfony\Component\Notifier\Transport(new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['notifier.transport_factory.null'] ?? $container->load('getNotifier_TransportFactory_NullService'));
        }, 1));
    }
}
