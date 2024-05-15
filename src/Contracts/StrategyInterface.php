<?php

declare(strict_types=1);

namespace Phillu\HyperfSms\Contracts;

interface StrategyInterface
{
    /**
     * Apply the strategy and return results.
     */
    public function apply(array $senders, MobileNumberInterface $number): array;
}
