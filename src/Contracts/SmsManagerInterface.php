<?php

declare(strict_types=1);

namespace HyperfLjh\Sms\Contracts;

interface SmsManagerInterface
{
    /**
     * Send the given message immediately.
     *
     * @throws \HyperfLjh\Sms\Exceptions\StrategicallySendMessageException
     */
    public function sendNow(SmsableInterface $smsable): array;

    /**
     * Send the given message.
     *
     * @return array|bool
     */
    public function send(SmsableInterface $smsable);

    /**
     * Queue the message for sending.
     */
    public function queue(SmsableInterface $smsable, ?string $queue = null): bool;

    /**
     * Deliver the queued message after the given delay.
     */
    public function later(SmsableInterface $smsable, int $delay, ?string $queue = null): bool;
}
