<?php

namespace ContainerCkA6dzx;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getAssetMapper_Compiler_SourceMappingUrlsCompilerService extends App_ShoppingList_Backend_ShoppingListBackendKernelTestDebugContainer
{
    /**
     * Gets the private 'asset_mapper.compiler.source_mapping_urls_compiler' shared service.
     *
     * @return \Symfony\Component\AssetMapper\Compiler\SourceMappingUrlsCompiler
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['asset_mapper.compiler.source_mapping_urls_compiler'] = new \Symfony\Component\AssetMapper\Compiler\SourceMappingUrlsCompiler();
    }
}
