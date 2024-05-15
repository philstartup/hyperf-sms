<?php

declare(strict_types=1);

namespace Phillu\HyperfSms\Contracts;

interface DriverInterface
{
    /**
     * Send the message.
     *
     * @throws \Phillu\HyperfSms\Exceptions\DriverErrorException
     */
    public function send(SmsableInterface $smsable): array;
}
