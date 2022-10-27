<?php
return [
    'default'    => env( 'aliyun.service','cdn' ),
    'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
    'access_key' => env( 'ALIYUN_ACCESS_KEY' ),
    'services'   => [
        'cdn'       => [
            'driver'     => 'cdn',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' ),
        ],
        'cloudauth' => [
            'driver'     => 'cloudAuth',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' ),
        ],
        'cloudpush' => [
            'driver'     => 'cloudPush',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' ),
        ],
        'dm'        => [
            'driver'     => 'dm',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' )
        ],
        'dns'       => [
            'driver'     => 'dns',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' ),
        ],
        'domain'    => [
            'driver'     => 'domain',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' )
        ],
        'green'       => [
            'driver'     => 'green',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' )
        ],
        'httpdns'       => [
            'driver'     => 'httpDns',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' )
        ],
        'jaq'       => [
            'driver'     => 'jaq',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' )
        ],
        'live'      => [
            'driver'     => 'live',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' )
        ],
        'mts'       => [
            'driver'     => 'mts',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' )
        ],
        'scdn'      => [
            'driver'     => 'scdn',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' )
        ],
        'sms'       => [
            'driver'     => 'sms',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' )
        ],
        'vod'       => [
            'driver'     => 'vod',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' )
        ],
        'vpc'       => [
            'driver'     => 'vpc',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' )
        ],
        'dypns'       => [
            'driver'     => 'dypns',
            'access_id'  => env( 'ALIYUN_ACCESS_ID' ),
            'access_key' => env( 'ALIYUN_ACCESS_KEY' )
        ],

    ],

];