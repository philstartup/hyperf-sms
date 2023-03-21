<?php

declare(strict_types=1);

namespace HyperfLjh\Sms;

use Hyperf\Utils\ApplicationContext;
use HyperfLjh\Contract\HasMailAddress;
use HyperfLjh\Sms\Contracts\SmsManagerInterface;

/**
 * @method static \HyperfLjh\Sms\PendingSms to(HasMailAddress|string $number, null|int|string $defaultRegion = null)
 */
class Sms
{
    public static function __callStatic(string $method, array $args)
    {
        $instance = static::getManager();

        return $instance->{$method}(...$args);
    }

    public static function sender(string $name)
    {
        return (new PendingSms(static::getManager()))->sender($name);
    }

    protected static function getManager()
    {
        return ApplicationContext::getContainer()->get(SmsManagerInterface::class);
    }
}
