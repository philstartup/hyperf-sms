<?php

declare(strict_types=1);

namespace HyperfLjh\Sms;

use HyperfLjh\Sms\Commands\GenSmsCommand;
use HyperfLjh\Sms\Contracts\SmsManagerInterface;
use HyperfLjh\Sms\Listeners\ValidatorFactoryResolvedListener;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                SmsManagerInterface::class => SmsManager::class,
            ],
            'commands'     => [
                GenSmsCommand::class,
            ],
            'listeners'    => [
                ValidatorFactoryResolvedListener::class,
            ],
            'publish'      => [
                [
                    'id'          => 'config',
                    'description' => 'The config for hyperf-ext/sms.',
                    'source'      => __DIR__ . '/../publish/sms.php',
                    'destination' => BASE_PATH . '/config/autoload/sms.php',
                ],
            ],
        ];
    }
}
