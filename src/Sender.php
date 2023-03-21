<?php

declare(strict_types=1);

namespace HyperfLjh\Sms;

use Hyperf\Macroable\Macroable;
use HyperfLjh\Sms\Contracts\SenderInterface;
use HyperfLjh\Sms\Contracts\SmsableInterface;
use HyperfLjh\Sms\Events\SmsMessageSending;
use HyperfLjh\Sms\Events\SmsMessageSent;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

class Sender implements SenderInterface
{
    use Macroable;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \HyperfLjh\Sms\Contracts\DriverInterface
     */
    protected $driver;

    /**
     * @var
     */
    protected $container;

    /**
     * @var \Psr\EventDispatcher\EventDispatcherInterface
     */
    protected $eventDispatcher;

    public function __construct(
        string $name,
        array $config,
        ContainerInterface $container
    ) {
        $this->name            = $name;
        $this->driver          = make($config['driver'], ['config' => $config['config'] ?? []]);
        $this->eventDispatcher = $container->get(EventDispatcherInterface::class);
        $this->container       = $container;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function send(SmsableInterface $smsable): array
    {
        $smsable = clone $smsable;

        call_user_func([$smsable, 'build'], $this);

        $this->eventDispatcher->dispatch(new SmsMessageSending($smsable));

        $response = $this->driver->send($smsable);

        $this->eventDispatcher->dispatch(new SmsMessageSent($smsable));

        return $response;
    }
}
