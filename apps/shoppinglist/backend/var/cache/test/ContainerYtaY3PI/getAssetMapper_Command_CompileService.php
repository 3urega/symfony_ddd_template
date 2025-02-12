<?php

namespace ContainerYtaY3PI;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getAssetMapper_Command_CompileService extends App_ShoppingList_Backend_ShoppingListBackendKernelTestDebugContainer
{
    /**
     * Gets the private 'asset_mapper.command.compile' shared service.
     *
     * @return \Symfony\Component\AssetMapper\Command\AssetMapperCompileCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        $container->privates['asset_mapper.command.compile'] = $instance = new \Symfony\Component\AssetMapper\Command\AssetMapperCompileCommand(($container->privates['asset_mapper.compiled_asset_mapper_config_reader'] ??= new \Symfony\Component\AssetMapper\CompiledAssetMapperConfigReader((\dirname(__DIR__, 4).'/public/assets'))), ($container->privates['asset_mapper'] ?? self::getAssetMapperService($container)), ($container->privates['asset_mapper.importmap.generator'] ?? $container->load('getAssetMapper_Importmap_GeneratorService')), ($container->privates['asset_mapper.local_public_assets_filesystem'] ??= new \Symfony\Component\AssetMapper\Path\LocalPublicAssetsFilesystem((\dirname(__DIR__, 4).'/public'))), \dirname(__DIR__, 4), true, ($container->services['event_dispatcher'] ?? self::getEventDispatcherService($container)));

        $instance->setName('asset-map:compile');
        $instance->setDescription('Compile all mapped assets and writes them to the final public output directory');

        return $instance;
    }
}
