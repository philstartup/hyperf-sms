<?php

declare(strict_types=1);

namespace HyperfLjh\Sms\Strategies;

use HyperfLjh\Sms\Concerns\HasSenderFilter;
use HyperfLjh\Sms\Contracts\MobileNumberInterface;
use HyperfLjh\Sms\Contracts\StrategyInterface;

class OrderStrategy implements StrategyInterface
{
    use HasSenderFilter;

    public function apply(array $senders, MobileNumberInterface $number): array
    {
        return array_values($this->filterSenders($senders, $number));
    }
}
