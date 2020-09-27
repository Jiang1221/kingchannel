<?php
namespace Jzb\common;

class Config{

    const GATEWAY_URL = 'http://develop.kingchannels.cn:50112/transfer';

    public static $appInfo = [
        'appId' => '', // 您的应用Id
        'appSecret' => '', // 您的应用秘钥
        'deviceToken' => '', // 获取到的deviceToken
        'apiVersion' => '1.0', // 接口版本号
        'appVersion' => '1.0.0', // 应用版本号
    ];

}

