<?php

namespace yzh52521\Aliyun\Services;

use GuzzleHttp\HandlerStack;
use yzh52521\Aliyun\BaseService;
use yzh52521\Aliyun\RpcStack;

/**
 * Class Jaq
 * 移动安全
 *
 * @method DiyShield( array $params ) 应用加固接口
 * @method GetShieldResult( array $params ) 查询应用加固结果接口
 * @method ScanVuln( array $params ) 漏洞扫描接口
 * @method ScanFake( array $params ) 仿冒检测接口
 * @method ScanMalware( array $params ) 恶意代码扫描接口
 * @method GetRiskDetail( array $params ) 查询扫描详细信息接口
 *
 */
class Jaq extends BaseService
{
    public function getBaseUri()
    {
        return 'https://jaq.aliyuncs.com';
    }

    /**
     * @var string
     */
    public $version = '2014-11-11';

    public $regionId = 'cn-hangzhou';

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
            'version'      => $this->version,
        ] );
        $stack->push( $middleware );
        return $stack;
    }
}