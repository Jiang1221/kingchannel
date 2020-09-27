 知传链接口调用SDK 1.0
=====================
> 运行环境要求PHP7.0+。

## 前期准备
*获取（申请）应用相关信息（appId,appSecret,deviceToken）

## 使用方法
* 1.在/src/common/Config.php文件中，填写获取到的应用ID,应用secret(appId,appSecret);
* 2.在你的代码中实例化Request类，实例化后调用getDeviceToken()，获取deviceToken，并将获得的deviceToken填写到配置文件（/src/common/Config.php）中。
* 3.在你的代码中实例化Request类，实例化后根据情况分别调用post()或get()方法，获取接口返回的结果。

## api文档


