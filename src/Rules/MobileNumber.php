<?php

declare(strict_types=1);

namespace HyperfLjh\Sms\Rules;

class MobileNumber
{
    /**
     * @var string[]
     */
    protected $regionCodes;

    /**
     * Create a new in rule instance.
     *
     * @param  null|string|string[]  $regionCodes
     */
    public function __construct($regionCodes = null, string ...$_)
    {
        if (is_array($regionCodes)) {
            $this->regionCodes = $regionCodes;
        } elseif (is_string($regionCodes)) {
            $this->regionCodes = array_merge([$regionCodes], $_);
        }
    }

    /**
     * Convert the rule to a validation string.
     *
     * @see \Hyperf\Validation\ValidationRuleParser::parseParameters
     */
    public function __toString(): string
    {
        return 'phone_number' . (empty($this->regionCodes) ? '' : ':' . implode(',', $this->regionCodes));
    }
}
