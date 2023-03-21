<?php

declare(strict_types=1);

namespace HyperfLjh\Sms\Events;

use HyperfLjh\Sms\Contracts\SmsableInterface;

class SmsMessageSent
{
    /**
     * The message instance.
     *
     * @var \HyperfLjh\Sms\Contracts\SmsableInterface
     */
    public $smsable;

    /**
     * Create a new event instance.
     */
    public function __construct(SmsableInterface $smsable)
    {
        $this->smsable = $smsable;
    }
}
