<?php

declare(strict_types=1);

namespace Phillu\HyperfSms\Concerns;

use Phillu\HyperfSms\Contracts\MobileNumberInterface;

trait HasSenderFilter
{
    protected function filterSenders(array $senders, MobileNumberInterface $number): array
    {
        $region = strtolower($number->getRegionCode());
        $output = [];
        foreach ($senders as $key => $value) {
            if (is_array($value)) {
                if (in_array($region, array_map('strtolower', $value))) {
                    $output[] = $key;
                }
            } else {
                $output[] = $value;
            }
        }
        return $output;
    }
}
