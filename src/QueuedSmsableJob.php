<?php

declare(strict_types=1);

namespace Phillu\HyperfSms;

use Hyperf\AsyncQueue\Job;
use Phillu\HyperfSms\Contracts\SmsableInterface;

class QueuedSmsableJob extends Job
{
    /**
     * @var \Phillu\HyperfSms\Contracts\SmsableInterface
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
