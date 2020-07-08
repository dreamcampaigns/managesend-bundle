<?php
/*
 * This file is part of the Managesend Bundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Managesend\ApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Managesend\ApiBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder("managesend_api");
        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('api_key')->defaultNull()->end()
            ->scalarNode('api_secret')->defaultNull()->end()
            ->scalarNode('client_id')->defaultNull()->end()
            ->integerNode('timeout')->min(0)->max(100)->defaultValue(60)->end() //default timeout: 60 secs
            ->end();

        return $treeBuilder;
    }
}
