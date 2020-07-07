<?php

namespace Managesend\ApiBundle\Tests\DependencyInjection;

use Managesend\ApiBundle\DependencyInjection\ManagesendApiExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ManagesendApiBundleExtensionTest extends TestCase
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    private $container;

    /**
     * @var \Managesend\ApiBundle\DependencyInjection\ManagesendApiExtension
     */
    private $extension;

    private $defaultConfig;

    public function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->extension = new ManagesendApiExtension();

        $this->defaultConfig = array(
            'api_key' => NULL,
            'api_secret' => NULL,
            'client_id' => NULL,
            'timeout' => 60
        );
    }

    public function testShouldLoadDefaultConfiguration()
    {
        $this->extension->load(array(), $this->container);

        $this->assertDefaultConfigDefinition($this->defaultConfig);
    }

    public function testShouldLoadCustomConfiguration()
    {
        $config = array(
            'api_key' => 'api_key',
            'api_secret'=>'api_secret',
            'client_id'=>'client_id',
            'timeout' => 10
        );

        $this->extension->load(array($config), $this->container);

        $this->assertDefaultConfigDefinition(array_replace($this->defaultConfig, $config));
    }

    public function testShouldResolveServices()
    {
        $config = array(
            'api_key' => 'api_key',
            'api_secret'=>'api_secret',
            'client_id'=>'client_id'
        );

        $this->extension->load(array($config), $this->container);

        $definition = $this->container->getDefinition('managesend_api');

        $this->assertEquals($this->container->getParameter("managesend_api_rest.class"), (string) $definition->getClass(),'managesend_api class is correct');

        $this->assertTrue($definition->isPublic());
    }

    /**
     * Assert that the default config definition loads the given options.
     *
     * @param array $config
     */
    private function assertDefaultConfigDefinition(array $config)
    {
        $this->assertTrue($this->container->hasDefinition('managesend_api'));

        $definition = $this->container->getDefinition('managesend_api');
        $paramClass = $this->container->getParameter('managesend_api_rest.class');
        $this->assertEquals($paramClass, $definition->getClass());
        $this->assertEquals(array($config), $definition->getArguments());
    }
}
