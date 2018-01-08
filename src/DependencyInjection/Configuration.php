<?php

namespace RFM\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{


    private $restrictions = array(
        '""', 'jpg', 'jpe', 'jpeg', 'gif',
        'png', 'svg', 'txt', 'pdf', 'odp',
        'ods', 'odt', 'rtf', 'doc', 'docx',
        'xls', 'xlsx', 'ppt', 'pptx', 'csv',
        'ogv', 'avi', 'mkv', 'mp4', 'webm',
        'm4v', 'ogg', 'mp3', 'wav', 'zip', 'md'
    );

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('rfm');
        $rootNode
            ->children()

            ->arrayNode('logger')
                ->children()
                    ->variableNode('enabled')->defaultTrue()->end()
                    ->variableNode('file')->defaultNull()->end()
                ->end()
            ->end()

            ->arrayNode('options')
                ->children()
                    ->variableNode('serverRoot')->defaultTrue()->end()
                    ->variableNode('fileRoot')->defaultFalse()->end()
                    ->variableNode('fileRootSizeLimit')->defaultFalse()->end()
                    ->variableNode('charsLatinOnly')->defaultFalse()->end()
                    ->variableNode('baseUrl')->defaultNull()->end()
                ->end()
            ->end()

            ->arrayNode('security')
                ->children()
                    ->variableNode('readOnly')->defaultFalse()->end()
                    ->arrayNode('extensions')
                        ->children()
                            ->variableNode('policy')->defaultValue('ALLOW_LIST')->end()
                            ->variableNode('ignoreCase')->defaultTrue()->end()
                            ->variableNode('restrictions')->defaultValue($this->restrictions)->end()
                        ->end()
                    ->end()
                    ->arrayNode('patterns')
                        ->children()
                            ->variableNode('policy')->defaultValue('DISALLOW_LIST')->end()
                            ->variableNode('ignoreCase')->defaultTrue()->end()
                            ->variableNode('restrictions')->defaultValue([ "*/.htaccess", "*/web.config", "*/.CDN_ACCESS_LOGS/*" ])->end()
                        ->end()
                    ->end()
                    ->variableNode('normalizeFilename')->defaultTrue()->end()
                    ->end()
            ->end()

            ->arrayNode('images')
                ->children()
                    ->arrayNode('thumbnail')
                        ->children()
                            ->variableNode('userLocalStorage')->defaultFalse()->end()
                        ->end()
                    ->end()
                ->end()
            ->end()

            ->variableNode('allowBulk')->defaultTrue()->end()
            ->variableNode('aclPolicy')->defaultValue('default')->end()
            ->variableNode('encryption')->defaultNull()->end()

            ->arrayNode('credentials')
                ->children()
                    ->variableNode('region')->defaultNull()->end()
                    ->variableNode('bucket')->defaultNull()->end()
                    ->variableNode('endpoint')->defaultNull()->end()
                    ->arrayNode('credentials')
                        ->children()
                            ->variableNode('key')->defaultNull()->end()
                            ->variableNode('secret')->defaultNull()->end()
                        ->end()
                    ->end()
                    ->arrayNode('credentials')
                        ->children()
                            ->variableNode('use_path_style_endpoint')->defaultNull()->end()
                        ->end()
                    ->end()
                    ->variableNode('defaultAcl')->defaultValue('public-read')->end()
                    ->variableNode('debug')->defaultFalse()->end()
                ->end()
            ->end()

            ->arrayNode('extra')
                ->children()
                    ->variableNode('mode')->defaultValue('local')->end()
//                    ->variableNode('requestPathParam')->defaultNull()->end()
//                    ->variableNode('configActionName')->defaultNull()->end()
                ->end()
            ->end()
            ->variableNode('credentials')->end()
            ->end();

        return $treeBuilder;
    }
}
