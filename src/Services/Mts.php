<?php

namespace yzh52521\Aliyun\Services;

use GuzzleHttp\HandlerStack;
use yzh52521\Aliyun\BaseService;
use yzh52521\Aliyun\RpcStack;

/**
 * Class Mts
 * 媒体转码
 *
 *
 * @see https://help.aliyun.com/document_detail/66804.html
 */
class Mts extends BaseService
{
    /**
     * @var string 接口版本
     */
    public $version = '2014-06-18';


    /**
     * @throws \Exception
     */
    public function init()
    {
        parent::init();
        if (empty ( $this->baseUrl )) {
            throw new \Exception ( 'The "baseUrl" property must be set.' );
        }
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
            'version'      => $this->version,
        ] );
        $stack->push( $middleware );
        return $stack;
    }
}