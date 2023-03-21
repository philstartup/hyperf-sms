<?php

declare(strict_types=1);

return [
    /**
     * 发送请求的超时时间
     */
    'timeout'                      => 5.0,

    /**
     * 默认的手机区号
     */
    'default_mobile_number_region' => 86,

    /**
     * 默认值
     */
    'default'                      => [
        // 发送策略
        'strategy' => \HyperfLjh\Sms\Strategies\OrderStrategy::class,
        // 发送驱动
        'senders'  => ['aliyun', 'tencent_cloud'],
    ],

    'senders' => [
        'aliyun' => [
            'driver' => \HyperfLjh\Sms\Drivers\AliyunDriver::class,
            'config' => [
                'access_key_id'     => '',
                'access_key_secret' => '',
                'sign_name'         => '',
            ],
        ],

        'baidu_cloud' => [
            'driver' => \HyperfLjh\Sms\Drivers\BaiduCloudDriver::class,
            'config' => [
                'ak'        => '',
                'sk'        => '',
                'invoke_id' => '',
                'domain'    => '',
            ],
        ],

        'huawei_cloud' => [
            'driver' => \HyperfLjh\Sms\Drivers\HuaweiCloudDriver::class,
            'config' => [
                'endpoint'   => '',
                'app_key'    => '',
                'app_secret' => '',
                'from'       => [
                    'default' => '',
                    // 'another' => '',
                ],
            ],
        ],

        'juhe_data' => [
            'driver' => \HyperfLjh\Sms\Drivers\JuheDataDriver::class,
            'config' => [
                'app_key' => '',
            ],
        ],

        'luosimao' => [
            'driver' => \HyperfLjh\Sms\Drivers\LuosimaoDriver::class,
            'config' => [
                'api_key' => '',
            ],
        ],

        'qiniu' => [
            'driver' => \HyperfLjh\Sms\Drivers\QiniuDriver::class,
            'config' => [
                'secret_key' => '',
                'access_key' => '',
            ],
        ],

        'rong_cloud' => [
            'driver' => \HyperfLjh\Sms\Drivers\RongCloudDriver::class,
            'config' => [
                'app_key'    => '',
                'app_secret' => '',
            ],
        ],

        'ronglian' => [
            'driver' => \HyperfLjh\Sms\Drivers\RonglianDriver::class,
            'config' => [
                'app_id'         => '',
                'account_sid'    => '',
                'account_token'  => '',
                'is_sub_account' => false,
            ],
        ],

        'send_cloud' => [
            'driver' => \HyperfLjh\Sms\Drivers\SendCloudDriver::class,
            'config' => [
                'sms_user'  => '',
                'sms_key'   => '',
                'timestamp' => false,
            ],
        ],

        'sms_bao' => [
            'driver' => \HyperfLjh\Sms\Drivers\SmsBaoDriver::class,
            'config' => [
                'user'     => '',
                'password' => '',
            ],
        ],

        'tencent_cloud' => [
            'driver' => \HyperfLjh\Sms\Drivers\TencentCloudDriver::class,
            'config' => [
                'sdk_app_id' => '',
                'secret_id'  => '',
                'secret_key' => '',
                'sign'       => null,
                'from'       => [ // sender_id
                    'default' => '',
                    // 'another' => '',
                ],
            ],
        ],

        'twillo' => [
            'driver' => \HyperfLjh\Sms\Drivers\TwilioDriver::class,
            'config' => [
                'account_sid' => '',
                'token'       => '',
                'from'        => [
                    'default' => '',
                    // 'another' => '',
                ],
            ],
        ],

        'ucloud' => [
            'driver' => \HyperfLjh\Sms\Drivers\UCloudDriver::class,
            'config' => [
                'private_key' => '',
                'public_key'  => '',
                'sig_content' => '',
                'project_id'  => '',
            ],
        ],

        'yunpian' => [
            'driver' => \HyperfLjh\Sms\Drivers\YunpianDriver::class,
            'config' => [
                'api_key'   => '',
                'signature' => '',
            ],
        ],

        'yunxin' => [
            'driver' => \HyperfLjh\Sms\Drivers\YunxinDriver::class,
            'config' => [
                'app_key'     => '',
                'app_secret'  => '',
                'code_length' => 4,
                'need_up'     => false,
            ],
        ],

        'log' => [
            'driver' => \HyperfLjh\Sms\Drivers\LogDriver::class,
            'config' => [
                'name'  => 'sms.local',
                'group' => 'default',
            ],
        ],
    ],

];
