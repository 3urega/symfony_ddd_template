<?php

namespace ContainerCkA6dzx;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getMessenger_Bus_Default_Messenger_HandlersLocatorService extends App_ShoppingList_Backend_ShoppingListBackendKernelTestDebugContainer
{
    /**
     * Gets the private 'messenger.bus.default.messenger.handlers_locator' shared service.
     *
     * @return \Symfony\Component\Messenger\Handler\HandlersLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['messenger.bus.default.messenger.handlers_locator'] = new \Symfony\Component\Messenger\Handler\HandlersLocator(['Symfony\\Component\\Process\\Messenger\\RunProcessMessage' => new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['.messenger.handler_descriptor.Die6Bxe'] ?? $container->load('get_Messenger_HandlerDescriptor_Die6BxeService'));
        }, 1), 'Symfony\\Component\\Console\\Messenger\\RunCommandMessage' => new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['.messenger.handler_descriptor.NumTeF8'] ?? $container->load('get_Messenger_HandlerDescriptor_NumTeF8Service'));
        }, 1), 'Symfony\\Component\\HttpClient\\Messenger\\PingWebhookMessage' => new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['.messenger.handler_descriptor.Qv3faSN'] ?? $container->load('get_Messenger_HandlerDescriptor_Qv3faSNService'));
        }, 1), 'Symfony\\Component\\Mailer\\Messenger\\SendEmailMessage' => new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['.messenger.handler_descriptor.WG.oRBv'] ?? $container->load('get_Messenger_HandlerDescriptor_WG_ORBvService'));
        }, 1), 'Symfony\\Component\\Messenger\\Message\\RedispatchMessage' => new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['.messenger.handler_descriptor.jyyWvHw'] ?? $container->load('get_Messenger_HandlerDescriptor_JyyWvHwService'));
        }, 1), 'Symfony\\Component\\Notifier\\Message\\ChatMessage' => new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['.messenger.handler_descriptor.gEx8y9a'] ?? $container->load('get_Messenger_HandlerDescriptor_GEx8y9aService'));
        }, 1), 'Symfony\\Component\\Notifier\\Message\\SmsMessage' => new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['.messenger.handler_descriptor.UKIJHil'] ?? $container->load('get_Messenger_HandlerDescriptor_UKIJHilService'));
        }, 1), 'Symfony\\Component\\Notifier\\Message\\PushMessage' => new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['.messenger.handler_descriptor.EXsqOW5'] ?? $container->load('get_Messenger_HandlerDescriptor_EXsqOW5Service'));
        }, 1)]);
    }
}
