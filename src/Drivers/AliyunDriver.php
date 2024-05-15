<?php

declare(strict_types=1);

namespace Phillu\HyperfSms\Drivers;

use Phillu\HyperfSms\Contracts\SmsableInterface;
use Phillu\HyperfSms\Exceptions\DriverErrorException;

class AliyunDriver extends AbstractDriver
{
    protected const ENDPOINT_URL = 'https://dysmsapi.aliyuncs.com';

    protected const ENDPOINT_METHOD = 'SendSms';

    protected const ENDPOINT_VERSION = '2017-05-25';

    protected const ENDPOINT_FORMAT = 'JSON';

    protected const ENDPOINT_SIGNATURE_METHOD = 'HMAC-SHA1';

    protected const ENDPOINT_SIGNATURE_VERSION = '1.0';

    public function send(SmsableInterface $smsable): array
    {
        $data = $smsable->data;

        $signName = $smsable->signature ?: $this->config->get('sign_name');

        $params = [
            'AccessKeyId'      => $this->config->get('access_key_id'),
            'Format'           => self::ENDPOINT_FORMAT,
            'SignatureMethod'  => self::ENDPOINT_SIGNATURE_METHOD,
            'SignatureVersion' => self::ENDPOINT_SIGNATURE_VERSION,
            'SignatureNonce'   => uniqid(),
            'Timestamp'        => gmdate('Y-m-d\TH:i:s\Z'),
            'Action'           => self::ENDPOINT_METHOD,
            'Version'          => self::ENDPOINT_VERSION,
            'PhoneNumbers'     => $smsable->to->getCountryCode() === 86 ? $smsable->to->getNationalNumber() : $smsable->to->getFullNumberWithIDDPrefix('CN'),
            'SignName'         => $signName,
            'TemplateCode'     => $smsable->template,
            'TemplateParam'    => json_encode($data, JSON_FORCE_OBJECT),
        ];

        $params['Signature'] = $this->generateSign($params);

        $response = $this->client->get(self::ENDPOINT_URL, $params);

        $result = $response->toArray();

        if ($result['Code'] != 'OK') {
            throw new DriverErrorException($result['Message'], $result['Code'], $response);
        }

        return $result;
    }

    protected function generateSign(array $params): string
    {
        ksort($params);
        $accessKeySecret = $this->config->get('access_key_secret');
        $stringToSign    = 'GET&%2F&' . urlencode(http_build_query($params, '', '&', PHP_QUERY_RFC3986));

        return base64_encode(hash_hmac('sha1', $stringToSign, $accessKeySecret . '&', true));
    }
}
