<?php

namespace yzh52521\Aliyun\Services;

use GuzzleHttp\HandlerStack;
use yzh52521\Aliyun\BaseService;
use yzh52521\Aliyun\RpcStack;

/**
 * 号码认证服务
 *
 * 一键登录和本机号码校验
 * @method GetMobile($params)  一键登录取号
 * @method VerifyMobile($params)  本机号码校验认证
 *
 * H5本机号码校验
 * @method GetAuthToken($params) 获取 H5 认证授权 Token 返回结果包括AccessToken和JwtToken
 * @method VerifyPhoneWithToken($params) 使用 Token 验证手机号码
 * @method GetPhoneWithToken($params) 一键登录取号（H5能力专用）
 *
 * @see https://help.aliyun.com/document_detail/405278.html
 */
class Dypns extends BaseService
{
    /**
     * @return string
     */
    public function getBaseUri()
    {
        return 'https://dypnsapi.aliyuncs.com';
    }

    /**
     * @var string 区域ID
     */
    protected $regionId = 'cn-hangzhou';

    /**
     * @return HandlerStack
     */
    public function getHttpStack()
    {
        $stack      = HandlerStack::create();
        $middleware = new RpcStack( [
            'accessKeyId'  => $this->accessId,
            'accessSecret' => $this->accessKey,
            'regionId'     => $this->regionId,
            'version'      => '2017-05-25',
        ] );
        $stack->push( $middleware );
        return $stack;
    }
}