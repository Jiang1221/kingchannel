<?php
require '../vendor/autoload.php'; // 修改为你的vendor下的autoload文件地址

use Jzb\Request;
$request = new Request();

// =========准备工作=================
// 步骤一：将获得的接口基地址、appId、appSecret、deviceToken填写到配置文件中（src/common/Config.php）

// ============================================
// 接口调用示例(获取资源信息)
//$contentDetail = $request->get('/resource/php/content/detail', ['id' => 759417590190706688]);
$contentDetail = Request::get('/resource/php/content/detail', ['id' => 759417590190706688]);
var_dump($contentDetail);exit;

