<?php

namespace yzh52521\Aliyun\Services;

use GuzzleHttp\HandlerStack;
use yzh52521\Aliyun\BaseService;
use yzh52521\Aliyun\RpcStack;

/**
 *
 * 域名操作
 * @method DescribeScdnDomainDetail(array $params) 获取指定加速域名配置的基本信息
 *
 * @see https://help.aliyun.com/document_detail/63609.html
 */
class Scdn extends BaseService
{
    /**
     * @var string 网关地址
     */
    public function getBaseUri()
    {
        return 'https://scdn.aliyuncs.com';
    }

    /**
     * @var string
     */
    public $version = '2017-11-15';

    /**
     * @return HandlerStack
     */
    public function getHttpStack()
    {
        $stack      = HandlerStack::create();
        $middleware = new RpcStack( [
            'accessKeyId'  => $this->accessId,
            'accessSecret' => $this->accessKey,
            'version'      => $this->version,
        ] );
        $stack->push( $middleware );
        return $stack;
    }
}