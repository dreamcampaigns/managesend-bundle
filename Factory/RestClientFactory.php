<?php
/*
 * This file is part of the Managesend Bundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Managesend\ApiBundle\Factory;

use Managesend\RestClient;

/**
 * Class RestClientFactory
 * @package Managesend\ApiBundle\Factory
 */
class RestClientFactory
{
    /**
     * @param array $config
     *
     * @return \Managesend\RestClient
     * @throws \Managesend\Exceptions\ConfigurationException
     */
    public static function create(array $config)
    {
        $restClient = new RestClient($config["api_key"],$config["api_secret"],$config["client_id"]);

        return $restClient;
    }
}