<?php
namespace Jzb\Common;

use GuzzleHttp\Client;
use function GuzzleHttp\Promise\is_settled;

class Helper
{
    public static function request(string $apiName, $method = 'GET', array $param = [], $timeout = 10)
    {
        if (empty($apiName)) return false;

        // 拼接完整地址
        $url = Config::GATEWAY_URL . $apiName;

        // 补充公共参数
        $param = self::getPublicParam($param);

        // 获取签名
        $param = self::generateToken($param);

        return self::guzzleRequest($url, $method, $param, $timeout);
    }


    /**
     * 使用guzzle请求
     * @param string $url 请求地址
     * @param string $method 请求方式
     * @param array $param 请求参数
     * @param int $timeout 请求超时时间
     * @return bool|mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function guzzleRequest(string $url, $method = 'GET', array $param = [], $timeout = 10)
    {
        // 是否在支持的请求方式内
        $methods = ['GET', 'POST'];
        $method = strtoupper($method);
        if (!in_array($method, $methods)) return false;

        //参数不为空 按请求方式组装请求参数
        if (!empty($param)) {
            $param = $method == 'GET' ? ['query' => $param] : ['form_params' => $param];
        }

        // 使用guzzle 发起请求
        try {
            $client = new Client(['verify' => false, 'timeout' => $timeout, 'http_errors' => false]); // https请求不验证cert
            $response = $client->request($method, $url, $param);
            $result = $response->getBody()->getContents();

            // 返回请求结果
            return self::setResult($result);

        } catch (\Exception $e) {
//            throw new MyException($e->getMessage());
            return [
                'Success' => false,
                'code' => 0,
                'description' => $e->getMessage(),
                'data' => null,
            ];
        }

    }


    /**
     * 处理结果
     */
    public static function setResult($result)
    {
        $data = [
            'Success' => true,
            'Code' => 200,
            'Description' => '',
            'Data' => null,
        ];

        // json转数组
        $res = json_decode($result, true);
        if (is_null($res)) {
            $data['Description'] = '无法解析返回结果';
            $data['Data'] = $result;
            return $data;
        }

        if(isset($res['Success'])) $data['Success'] = $res['Success'];
        if(isset($res['Code'])) $data['Code'] = $res['Code'];
        if(isset($res['Description'])) $data['Description'] = $res['Description'];
        if(isset($res['Data'])) $data['Data'] = $res['Data'];
        return $data;
    }


    /**
     * 补充公共参数
     * @param $param
     * @return array
     * @throws MyException
     */
    public static function getPublicParam($param)
    {
        // 判断配置信息是否填写
        foreach (Config::$appInfo as $v){
            if(empty($v)) throw new MyException('请先填写配置信息');
        }

        $clientTimezone = date_default_timezone_get(); // 获取用户当前配置的时区 用户没配置时 默认是UTC时间
        if($clientTimezone != 'UTC') date_default_timezone_set('UTC'); // 使用0时区时间
        $time = date('Y-m-d H:i:s');
        if($clientTimezone != 'UTC') date_default_timezone_set($clientTimezone); // 改回用户自己设置的时区

        // 从配置文件中取相关参数
        $publicParam = [
            'X_Public_AppId' => Config::$appInfo['appId'],
            'X_Public_ApiVersion' => Config::$appInfo['deviceToken'],
            'X_Public_DeviceToken' => Config::$appInfo['apiVersion'],
            'X_Public_AppVersion' => Config::$appInfo['apiVersion'],
            'X_Public_TimeStamp' => $time,
            'X_Public_Nonce' => md5(uniqid(microtime(true),true)), // 唯一随机32位字符串
        ];

        return array_merge($param, $publicParam);
    }


    /**
     * 根据参数生成签名
     * @param array $param 请求参数
     * @return array|bool
     */
    public static function generateToken(array $param)
    {
        if (empty($param) || !is_array($param)) return false;

        // 按参数名自然排序（不区分大小写升序排序）
        ksort($param, SORT_NATURAL | SORT_FLAG_CASE);

        $str = '';
        foreach ($param as $key => $value) {
            $str .= $key . '=' . $value;
        }

        // 拼接应用秘钥
        $str .= Config::$appInfo['appSecret'];

        // sha1加密后的字符串为公共参数X_Public_Token的值
        $param['X_Public_Token'] = sha1($str);

        return $param;
    }


}

