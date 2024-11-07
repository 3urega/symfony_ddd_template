<?php

namespace ContainerYtaY3PI;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTest_Client_CookiejarService extends App_ShoppingList_Backend_ShoppingListBackendKernelTestDebugContainer
{
    /**
     * Gets the private 'test.client.cookiejar' service.
     *
     * @return \Symfony\Component\BrowserKit\CookieJar
     */
    public static function do($container, $lazyLoad = true)
    {
        $container->factories['service_container']['test.client.cookiejar'] = function ($container) {
            return new \Symfony\Component\BrowserKit\CookieJar();
        };

        return $container->factories['service_container']['test.client.cookiejar']($container);
    }
}
