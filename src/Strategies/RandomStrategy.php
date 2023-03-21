<?php

declare(strict_types=1);

namespace HyperfLjh\Sms\Strategies;

use HyperfLjh\Sms\Concerns\HasSenderFilter;
use HyperfLjh\Sms\Contracts\MobileNumberInterface;
use HyperfLjh\Sms\Contracts\StrategyInterface;

class RandomStrategy implements StrategyInterface
{
    use HasSenderFilter;

    public function apply(array $senders, MobileNumberInterface $number): array
    {
        $senders = $this->filterSenders($senders, $number);

        uasort($senders, function () {
            return mt_rand() - mt_rand();
        });

        return array_values($senders);
    }
}
