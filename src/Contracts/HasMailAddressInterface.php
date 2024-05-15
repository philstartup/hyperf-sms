<?php

declare(strict_types=1);

namespace Phillu\HyperfSms\Contracts;

interface HasMailAddressInterface
{
    /**
     * Get the mail address of the entity.
     */
    public function getMailAddress(): ?string;

    /**
     * Get the mail address display name of the entity.
     */
    public function getMailAddressDisplayName(): ?string;
}
