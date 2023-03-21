<?php

declare(strict_types=1);

namespace HyperfLjh\Sms\Contracts;

interface DriverInterface
{
    /**
     * Send the message.
     *
     * @throws \HyperfLjh\Sms\Exceptions\DriverErrorException
     */
    public function send(SmsableInterface $smsable): array;
}
