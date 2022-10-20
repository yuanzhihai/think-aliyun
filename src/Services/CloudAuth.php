<?php

namespace yzh52521\Aliyun\Services;

use GuzzleHttp\HandlerStack;
use yzh52521\Aliyun\BaseService;
use yzh52521\Aliyun\RpcStack;

/**
 * Class CloudAuth
 * 实人认证 服务端SDK
 *
 * @method getStatus( array $params ) 查询认证状态
 * @method getVerifyToken( array $params ) 发起认证请求
 * @method submitMaterials( array $params ) 提交认证资料
 * @method getMaterials( array $params ) 获取认证资料
 * @method compareFaces( array $params ) 人脸比对验证
 *
 */
class CloudAuth extends BaseService
{
    /**
     * @return string
     */
    public function getBaseUri()
    {
        return 'https://cloudauth.aliyuncs.com';
    }

    /**
     * @var string
     */
    public $version = '2017-10-10';

    /**
     * @return HandlerStack
     */
    public function getHttpStack()
    {
        $stack      = HandlerStack::create();
        $middleware = new RpcStack( [
            'accessKeyId'  => $this->accessId,
            'accessSecret' => $this->accessKey,
            'version'      => $this->version
        ] );
        $stack->push( $middleware );
        return $stack;
    }
}