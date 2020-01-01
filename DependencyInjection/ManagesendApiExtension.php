<?php
/*
 * This file is part of the Managesend Bundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Managesend\ApiBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Managesend\RestClient;

/**
 * Class ManagesendApiExtension
 * @package Managesend\ApiBundle\DependencyInjection
 */
class ManagesendApiExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $parametersClass = $container->getParameter('managesend_api_rest.class');
        $configId = "managesend_api";

        $configDefinition = new Definition($parametersClass);
        $configDefinition->setPublic(true);
        $configDefinition->setFactory(array('Managesend\ApiBundle\Factory\RestClientFactory', 'create'));
        $configDefinition->addArgument($config);
        $container->setDefinition($configId, $configDefinition);

        $config['api_key'] = $config['api_key'] ?: $_ENV[RestClient::ENV_TOKEN_KEY];
        $config['api_secret'] = $config['api_secret'] ?: $_ENV[RestClient::ENV_TOKEN_SECRET];
        $config['client_id'] = $config['client_id'] ?: $_ENV[RestClient::ENV_CLIENT_ID];

        $container->setParameter('managesend_api.api_key', $config['api_key']);
        $container->setParameter('managesend_api.api_secret', $config['api_secret']);
        $container->setParameter('managesend_api.client_id', $config['client_id']);
        $container->setParameter('managesend_api.timeout', $config['timeout']);
    }

    public function getAlias()
    {
        return 'managesend_api';
    }
}
