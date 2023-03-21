<?php

declare(strict_types=1);

namespace HyperfLjh\Sms\Drivers;

use Hyperf\Config\Config;
use HyperfLjh\Sms\Client;
use HyperfLjh\Sms\Contracts\DriverInterface;

abstract class AbstractDriver implements DriverInterface
{
    /**
     * @var \HyperfLjh\Sms\Client
     */
    protected $client;

    /**
     * @var \Hyperf\Config\Config
     */
    protected $config;

    /**
     * The driver constructor.
     */
    public function __construct(array $config)
    {
        $this->config = new Config($config);
        $this->client = new Client($this->getClientOptions());
    }

    /**
     * Return base Guzzle options.
     */
    protected function getClientOptions(): array
    {
        $options = method_exists($this, 'getGuzzleOptions') ? $this->getGuzzleOptions() : [];

        return array_merge($this->config->get('guzzle', []), $options, [
            'base_uri' => method_exists($this, 'getBaseUri') ? $this->getBaseUri() : '',
            'timeout'  => method_exists($this, 'getTimeout') ? $this->getTimeout() : 5.0,
        ]);
    }
}
