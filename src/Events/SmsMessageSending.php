<?php

declare(strict_types=1);

namespace Phillu\HyperfSms\Events;

use Phillu\HyperfSms\Contracts\SmsableInterface;

class SmsMessageSending
{
    /**
     * The message instance.
     *
     * @var \Phillu\HyperfSms\Contracts\SmsableInterface
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
