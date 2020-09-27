<?php
namespace Jzb;

use Jzb\common\Config;
use Jzb\Common\Helper;
use Jzb\common\MyException;

class Request
{
    /**
     * @param string $apiName 接口地址 例如: /passport/net/passport/login
     * @param array $param 请求接口所用参数 key=>value模式 例如：['number' => '13800000001', 'password' => '123456']
     * @return bool|mixed|string
     */
    public function post(string $apiName, array $param = []){
        return Helper::request($apiName, 'POST', $param);
    }

    /**
     * @param string $apiName 接口地址 例如: /resource/php/content/detail
     * @param array $param 请求接口所用参数 key=>value模式 例如：['id' => 758993325901484032]
     * @return bool|mixed|string
     */
    public function get(string $apiName, array $param = []){
        return Helper::request($apiName, 'GET', $param);
    }


    /**
     * 获取设备编码
     */
    /*public function getDeviceToken()
    {
        $url = Config::GATEWAY_URL . '/passport/net/device/create';
        $deviceToken = md5(uniqid(microtime(true),true));
        $param['dataJson'] = json_encode(['DeviceToken' =>$deviceToken], JSON_UNESCAPED_UNICODE);
        $param = Helper::getPublicParam($param);
        $param = Helper::generateToken($param);

        $res = Helper::guzzleRequest($url, 'POST', $param);
        if (isset($res['Success']) && $res['Success'] == true) {
            return $deviceToken;
        }

        throw new MyException('绑定设备失败!');

    }*/


}