<?php

declare(strict_types=1);

namespace Phillu\HyperfSms;

use Phillu\HyperfSms\Commands\GenSmsCommand;
use Phillu\HyperfSms\Contracts\SmsManagerInterface;
use Phillu\HyperfSms\Listeners\ValidatorFactoryResolvedListener;

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
                    'description' => 'The config for phillu/hyperf-sms.',
                    'source'      => __DIR__ . '/../publish/sms.php',
                    'destination' => BASE_PATH . '/config/autoload/sms.php',
                ],
            ],
        ];
    }
}
