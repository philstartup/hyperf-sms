<?php

declare(strict_types=1);

namespace HyperfLjh\Sms;

use Hyperf\AsyncQueue\Job;
use HyperfLjh\Sms\Contracts\SmsableInterface;

class QueuedSmsableJob extends Job
{
    /**
     * @var \HyperfLjh\Sms\Contracts\SmsableInterface
     */
    public $smsable;

    public function __construct(SmsableInterface $smsable)
    {
        $this->smsable = $smsable;
    }

    public function handle()
    {
        $this->smsable->send();
    }
}
