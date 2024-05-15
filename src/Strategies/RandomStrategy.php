<?php

declare(strict_types=1);

namespace Phillu\HyperfSms\Strategies;

use Phillu\HyperfSms\Concerns\HasSenderFilter;
use Phillu\HyperfSms\Contracts\MobileNumberInterface;
use Phillu\HyperfSms\Contracts\StrategyInterface;

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
