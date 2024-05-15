<?php

declare(strict_types=1);

namespace Phillu\HyperfSms;

use Hyperf\Context\ApplicationContext;
use Phillu\HyperfSms\Contracts\HasMobileNumberInterface;
use Phillu\HyperfSms\Contracts\SmsableInterface;
use Phillu\HyperfSms\Contracts\SmsManagerInterface;

class PendingSms
{
    /**
     * The "to" recipient of the message.
     *
     * @var \Phillu\HyperfSms\Contracts\MobileNumberInterface
     */
    protected $to;

    /**
     * @var \Phillu\HyperfSms\Contracts\SmsManagerInterface
     */
    protected $manger;

    /**
     * @var \Phillu\HyperfSms\Contracts\SenderInterface
     */
    protected $sender;

    public function __construct(SmsManagerInterface $manger)
    {
        $this->manger = $manger;
    }

    /**
     * Set the recipients of the message.
     *
     * @param  \Phillu\HyperfSms\Contracts\HasMobileNumberInterface|string  $number
     * @param  null|int|string  $defaultRegion
     *
     * @return $this
     * @throws \Phillu\HyperfSms\Exceptions\InvalidMobileNumberException
     */
    public function to($number, $defaultRegion = null)
    {
        $number = $number instanceof HasMobileNumberInterface ? $number->getMobileNumber() : $number;

        $this->to = new MobileNumber($number, $defaultRegion);

        return $this;
    }

    /**
     * Set the sender of the SMS message.
     *
     * @return $this
     */
    public function sender(string $name)
    {
        $this->sender = ApplicationContext::getContainer()->get(SmsManagerInterface::class)->get($name);

        return $this;
    }

    /**
     * Send a new SMS message instance immediately.
     */
    public function sendNow(SmsableInterface $smsable): array
    {
        return $this->manger->sendNow($this->fill($smsable));
    }

    /**
     * Send a new SMS message instance.
     *
     * @return array|bool
     */
    public function send(SmsableInterface $smsable)
    {
        return $this->manger->send($this->fill($smsable));
    }

    /**
     * Push the given SMS message onto the queue.
     */
    public function queue(SmsableInterface $smsable, ?string $queue = null): bool
    {
        return $this->manger->queue($this->fill($smsable), $queue);
    }

    /**
     * Deliver the queued SMS message after the given delay.
     */
    public function later(SmsableInterface $smsable, int $delay, ?string $queue = null): bool
    {
        return $this->manger->later($this->fill($smsable), $delay, $queue);
    }

    /**
     * Populate the SMS message with the addresses.
     */
    protected function fill(SmsableInterface $smsable): SmsableInterface
    {
        $smsable->to($this->to);
        if ($this->sender) {
            $smsable->sender($this->sender->getName());
        }
        return $smsable;
    }
}
