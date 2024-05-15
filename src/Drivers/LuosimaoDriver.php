<?php

declare(strict_types=1);

namespace Phillu\HyperfSms\Drivers;

use Phillu\HyperfSms\Contracts\SmsableInterface;
use Phillu\HyperfSms\Exceptions\DriverErrorException;

/**
 * @see https://luosimao.com/docs/api/
 */
class LuosimaoDriver extends AbstractDriver
{
    protected const ENDPOINT_TEMPLATE = 'https://%s.luosimao.com/%s/%s.%s';

    protected const ENDPOINT_VERSION = 'v1';

    protected const ENDPOINT_FORMAT = 'json';

    public function send(SmsableInterface $smsable): array
    {
        $endpoint = $this->buildEndpoint('sms-api', 'send');

        $response = $this->client->post($endpoint, [
            'mobile'  => $smsable->to->getNationalNumber(),
            'message' => $smsable->content,
        ], [
            'Authorization' => 'Basic ' . base64_encode('api:key-' . $this->config->get('api_key')),
        ]);

        $result = $response->toArray();

        if ($result['error']) {
            throw new DriverErrorException($result['msg'], $result['error'], $response);
        }

        return $result;
    }

    protected function buildEndpoint(string $type, string $function): string
    {
        return sprintf(self::ENDPOINT_TEMPLATE, $type, self::ENDPOINT_VERSION, $function, self::ENDPOINT_FORMAT);
    }
}
