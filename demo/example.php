<?php
require '../vendor/autoload.php'; // 修改为你的vendor下的autoload文件地址

use Jzb\Request;
$request = new Request();

// =========准备工作=================
// 步骤一：将获得的appId/secret填写到配置文件中（src/common/Config.php）

// 步骤二：获取deviceToken（只需调用一次，将获取得字符串填写到配置文件中）
//$deviceToken = $request->getDeviceToken();
//var_dump($deviceToken); // 将获取到的deviceToken写入配置文件中（src/common/Config.php）


// ============================================
// 接口调用示例(获取资源信息)
$contentDetail = $request->get('/resource/php/content/detail', ['id' => 759417590190706688]);
var_dump($contentDetail);exit;

