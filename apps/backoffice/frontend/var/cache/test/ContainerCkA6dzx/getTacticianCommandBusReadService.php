<?php

namespace ContainerCkA6dzx;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTacticianCommandBusReadService extends App_ShoppingList_Backend_ShoppingListBackendKernelTestDebugContainer
{
    /**
     * Gets the private 'Eurega\Shared\Infrastructure\Bus\Command\Tactician\TacticianCommandBusRead' shared autowired service.
     *
     * @return \Eurega\Shared\Infrastructure\Bus\Command\Tactician\TacticianCommandBusRead
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['Eurega\\Shared\\Infrastructure\\Bus\\Command\\Tactician\\TacticianCommandBusRead'] = new \Eurega\Shared\Infrastructure\Bus\Command\Tactician\TacticianCommandBusRead(($container->services['tactician.commandbus.default'] ?? $container->load('getTactician_Commandbus_DefaultService')));
    }
}
