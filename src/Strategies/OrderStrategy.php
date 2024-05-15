<?php

declare(strict_types=1);

namespace Phillu\HyperfSms\Strategies;

use Phillu\HyperfSms\Concerns\HasSenderFilter;
use Phillu\HyperfSms\Contracts\MobileNumberInterface;
use Phillu\HyperfSms\Contracts\StrategyInterface;

class OrderStrategy implements StrategyInterface
{
    use HasSenderFilter;

    public function apply(array $senders, MobileNumberInterface $number): array
    {
        return array_values($this->filterSenders($senders, $number));
    }
}
