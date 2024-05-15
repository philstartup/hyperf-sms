<?php

declare(strict_types=1);

namespace Phillu\HyperfSms\Drivers;

use GuzzleHttp\Exception\ClientException;
use Phillu\HyperfSms\Contracts\SmsableInterface;
use Phillu\HyperfSms\Exceptions\DriverErrorException;

/**
 * @see https://www.twilio.com/docs/api/messaging/send-messages
 */
class TwilioDriver extends AbstractDriver
{
    protected const ENDPOINT_URL = 'https://api.twilio.com/2010-04-01/Accounts/%s/Messages.json';

    protected $errorStatuses = [
        'failed',
        'undelivered',
    ];

    public function send(SmsableInterface $smsable): array
    {
        $accountSid = $this->config->get('account_sid');
        $endpoint   = $this->buildEndPoint($accountSid);

        $params = [
            'To'   => $smsable->to->toE164(),
            'From' => $this->config->get('from' . ($smsable->from ?: 'default')),
            'Body' => $smsable->content,
        ];

        try {
            $response = $this->client->request('post', $endpoint, [
                'auth'        => [
                    $accountSid,
                    $this->config->get('token'),
                ],
                'form_params' => $params,
            ]);

            $result = $response->toArray();

            if (in_array($result['status'], $this->errorStatuses) || !is_null($result['error_code'])) {
                throw new DriverErrorException($result['message'], $result['error_code'], $response);
            }
        } catch (ClientException $e) {
            throw new DriverErrorException($e->getMessage(), $e->getCode(), $e->getResponse(), $e);
        }

        return $result;
    }

    protected function buildEndPoint(string $accountSid): string
    {
        return sprintf(self::ENDPOINT_URL, $accountSid);
    }
}
