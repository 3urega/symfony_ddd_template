<?php

namespace ContainerYtaY3PI;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getValidator_ExpressionLanguageProviderService extends App_ShoppingList_Backend_ShoppingListBackendKernelTestDebugContainer
{
    /**
     * Gets the private 'validator.expression_language_provider' shared service.
     *
     * @return \Symfony\Component\Validator\Constraints\ExpressionLanguageProvider
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['validator.expression_language_provider'] = new \Symfony\Component\Validator\Constraints\ExpressionLanguageProvider();
    }
}
