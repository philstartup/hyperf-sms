<?php

declare(strict_types=1);

namespace Phillu\HyperfSms\Contracts;

interface HasMobileNumberInterface
{
    /**
     * Get the mobile number of the entity.
     * Must be E.164 international standard format (CC+NDC+SN, eg. +8618812345678).
     */
    public function getMobileNumber(): ?string;
}
