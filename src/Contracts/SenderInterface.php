<?php

declare(strict_types=1);

namespace HyperfLjh\Sms\Contracts;

interface SenderInterface
{
    /**
     * Get the sender name.
     */
    public function getName(): string;

    /**
     * Send the message immediately.
     *
     * @throws \HyperfLjh\Sms\Exceptions\DriverErrorException
     */
    public function send(SmsableInterface $smsable): array;
}
