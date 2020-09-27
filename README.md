 知传链接口调用SDK 1.0
=====================
> 运行环境要求PHP7.0+。

## 前期准备
获取（申请）应用相关信息（接口基地址、appId、appSecret、deviceToken）

## 使用方法
* 1.在/src/common/Config.php文件中，填写获取到的接口基地址、应用ID、应用secret(GATEWAY_URL、appId、appSecret、deviceToken);
* 2.在你的代码中实例化Request类，实例化后根据接口文档定义的方法，分别调用post()或get()方法，获取接口返回的结果。

## api文档


