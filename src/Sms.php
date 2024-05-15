<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-05-15 16:33:51
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-05-15 17:46:36
 * @FilePath: \WM-platform\wm-php\vendor\phillu\hyperf-sms\src\Sms.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Phillu\HyperfSms;

use Hyperf\Context\ApplicationContext;
use Phillu\HyperfSms\Contracts\HasMailAddressInterface;
use Phillu\HyperfSms\Contracts\SmsManagerInterface;

/**
 * @method static \Phillu\HyperfSms\PendingSms to(HasMailAddressInterface|string $number, null|int|string $defaultRegion = null)
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
