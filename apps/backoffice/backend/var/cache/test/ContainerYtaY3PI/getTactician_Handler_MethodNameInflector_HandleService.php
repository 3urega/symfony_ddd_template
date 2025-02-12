<?php

namespace ContainerYtaY3PI;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTactician_Handler_MethodNameInflector_HandleService extends App_ShoppingList_Backend_ShoppingListBackendKernelTestDebugContainer
{
    /**
     * Gets the private 'tactician.handler.method_name_inflector.handle' shared service.
     *
     * @return \League\Tactician\Handler\MethodNameInflector\HandleInflector
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['tactician.handler.method_name_inflector.handle'] = new \League\Tactician\Handler\MethodNameInflector\HandleInflector();
    }
}
