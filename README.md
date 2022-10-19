# think-aliyun

This is a aliyun expansion for the think

[![License](https://poser.pugx.org/yzh52521/think-aliyun/license.svg)](https://packagist.org/packages/yzh52521/think-aliyun)
[![Latest Stable Version](https://poser.pugx.org/yzh52521/think-aliyun/v/stable.png)](https://packagist.org/packages/yzh52521/think-aliyun)
[![Total Downloads](https://poser.pugx.org/yzh52521/think-aliyun/downloads.png)](https://packagist.org/packages/yzh52521/think-aliyun)

## 接口支持
- CDN
- 移动推送
- DM 邮件推送
- DNS 
- DOMAIN 域名
- MTS 媒体转码
- SCDN 域名操作
- SMS短信
- VOD 视频点播
- VPC 弹性Ip

## 环境需求

- PHP >= 7.4

## 安装

```bash
composer require yzh52521/think-aliyun
```

## 使用

```php
try {
	$aliyun = Aliyun::service('cdn');
	$cdn->RefreshObjectCaches([
		'ObjectPath' => [
			'http://www.baidu.com',
		],
		'ObjectType' => 'File'
	]);
} catch (\Exception $e) {
	print_r($e->getMessage());
}
```