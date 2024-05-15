<?php

declare(strict_types=1);

namespace Phillu\HyperfSms\Contracts;

interface SenderInterface
{
    /**
     * Get the sender name.
     */
    public function getName(): string;

    /**
     * Send the message immediately.
     *
     * @throws \Phillu\HyperfSms\Exceptions\DriverErrorException
     */
    public function send(SmsableInterface $smsable): array;
}
