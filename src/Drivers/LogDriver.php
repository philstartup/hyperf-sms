<?php

declare(strict_types=1);

namespace HyperfLjh\Sms\Drivers;

use Hyperf\Logger\LoggerFactory;
use HyperfLjh\Sms\Contracts\SmsableInterface;
use Psr\Container\ContainerInterface;

class LogDriver extends AbstractDriver
{
    /**
     * The Logger instance.
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    public function __construct(ContainerInterface $container, array $config)
    {
        parent::__construct($config);

        $this->logger = $container->get(LoggerFactory::class)->get(
            $config['name'] ?? 'sms.local',
            $config['group'] ?? 'default'
        );
    }

    public function send(SmsableInterface $smsable): array
    {
        $log = sprintf(
            "To: %s | Content: \"%s\" | Template: \"%s\" | Data: %s",
            $smsable->to->toE164(),
            $smsable->content,
            $smsable->template,
            json_encode($smsable->data)
        );

        $this->logger->debug($log);

        return [];
    }
}
