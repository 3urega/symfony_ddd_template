<?php

namespace ContainerCkA6dzx;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getCache_GlobalClearerService extends App_ShoppingList_Backend_ShoppingListBackendKernelTestDebugContainer
{
    /**
     * Gets the public 'cache.global_clearer' shared service.
     *
     * @return \Symfony\Component\HttpKernel\CacheClearer\Psr6CacheClearer
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->services['cache.global_clearer'] = new \Symfony\Component\HttpKernel\CacheClearer\Psr6CacheClearer(['cache.app' => ($container->services['cache.app'] ?? $container->load('getCache_AppService')), 'cache.system' => ($container->services['cache.system'] ?? $container->load('getCache_SystemService')), 'cache.asset_mapper' => ($container->privates['cache.asset_mapper'] ?? self::getCache_AssetMapperService($container)), 'cache.messenger.restart_workers_signal' => ($container->privates['cache.messenger.restart_workers_signal'] ?? $container->load('getCache_Messenger_RestartWorkersSignalService')), 'cache.validator_expression_language' => ($container->services['cache.validator_expression_language'] ?? $container->load('getCache_ValidatorExpressionLanguageService'))]);
    }
}
