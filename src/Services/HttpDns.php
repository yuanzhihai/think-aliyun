<?php

namespace yzh52521\Aliyun\Services;

use GuzzleHttp\HandlerStack;
use yzh52521\Aliyun\BaseService;
use yzh52521\Aliyun\RpcStack;

/**
 * Class HttpDns
 *
 * @method getAccountInfo() 获取账户信息接口
 * @method getResolveStatistics(array $params) 获取解析统计信息接口
 * @method listDomains(array $params) 获取用户域名及解析次数接口
 * @method deleteDomain(array $params) 删除域名接口
 * @method addDomain(array $params) 添加域名接口
 *
 */
class HttpDns extends BaseService
{
    public function getBaseUri()
    {
        return 'https://httpdns-api.aliyuncs.com';
    }

    /**
     * @return HandlerStack
     */
    public function getHttpStack()
    {
        $stack      = HandlerStack::create();
        $middleware = new RpcStack( [
            'accessKeyId'  => $this->accessId,
            'accessSecret' => $this->accessKey,
            'version'      => '2016-02-01',
        ] );
        $stack->push( $middleware );
        return $stack;
    }
}