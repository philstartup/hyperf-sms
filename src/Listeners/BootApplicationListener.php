<?php

declare(strict_types=1);

namespace HyperfLjh\Sms\Listeners;

use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Framework\Event\BootApplication;
use Hyperf\Validation\Rule;
use HyperfLjh\Sms\Rules\MobileNumber;
use HyperfLjh\Sms\Rules\MobileNumberFormat;

class BootApplicationListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            BootApplication::class,
        ];
    }

    public function process(object $event): void
    {
        if (!Rule::hasMacro('mobileNumber')) {
            Rule::macro('mobileNumber', function ($regionCodes, string ...$_) {
                return new MobileNumber($regionCodes, ...$_);
            });
        }

        if (!Rule::hasMacro('mobileNumberFormat')) {
            Rule::macro('mobileNumberFormat', function (string $format, ?string $defaultRegion = null) {
                return new MobileNumberFormat($format, $defaultRegion);
            });
        }
    }
}
