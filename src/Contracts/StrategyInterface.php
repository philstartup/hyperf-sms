<?php

declare(strict_types=1);

namespace HyperfLjh\Sms\Contracts;

interface StrategyInterface
{
    /**
     * Apply the strategy and return results.
     */
    public function apply(array $senders, MobileNumberInterface $number): array;
}
