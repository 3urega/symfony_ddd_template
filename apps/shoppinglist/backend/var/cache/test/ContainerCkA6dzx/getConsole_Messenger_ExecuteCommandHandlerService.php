<?php

namespace ContainerCkA6dzx;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getConsole_Messenger_ExecuteCommandHandlerService extends App_ShoppingList_Backend_ShoppingListBackendKernelTestDebugContainer
{
    /**
     * Gets the private 'console.messenger.execute_command_handler' shared service.
     *
     * @return \Symfony\Component\Console\Messenger\RunCommandMessageHandler
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['console.messenger.execute_command_handler'] = new \Symfony\Component\Console\Messenger\RunCommandMessageHandler((isset($container->factories['service_container']['console.messenger.application']) ? $container->factories['service_container']['console.messenger.application']($container) : $container->load('getConsole_Messenger_ApplicationService')));
    }
}
