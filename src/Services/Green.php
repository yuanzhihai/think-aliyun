<?php

namespace yzh52521\Aliyun\Services;

use GuzzleHttp\HandlerStack;
use yzh52521\Aliyun\AcsStack;
use yzh52521\Aliyun\BaseService;

/**
 * 内容安全API
 *
 * @see https://help.aliyun.com/document_detail/53412.html
 */
class Green extends BaseService
{
    /**
     * @var string 网关地址
     */
    public function getBaseUri()
    {
        return 'https://green.cn-hangzhou.aliyuncs.com';
    }

    /**
     * @var string 绿网接口版本，当前版本为：2017-01-12
     */
    public $version = '2017-01-12';

    /**
     * @var string 可用区
     */
    public $regionId = 'cn-hangzhou';

    /**
     * @return HandlerStack
     */
    public function getHttpStack()
    {
        $stack      = HandlerStack::create();
        $middleware = new AcsStack( [
            'accessKeyId'  => $this->accessId,
            'accessSecret' => $this->accessKey,
            'version'      => $this->version,
            'regionId'     => $this->regionId
        ] );
        $stack->push( $middleware );
        return $stack;
    }

    /**
     * 同步图片鉴黄暴恐
     * @param array $tasks
     * @return mixed
     */
    public function imageScan($tasks = [])
    {
        foreach ( $tasks as $key => $val ) {
            if (!isset( $val['dataId'] )) $tasks[$key]['dataId'] = uniqid();
        }
        return $this->post( '/green/image/scan',[
            "tasks"  => $tasks,
            "scenes" => [
                'porn','terrorism'
            ]
        ] );
    }

    /**
     * 同步图像OCI识别
     * @param array $tasks
     * @return mixed
     */
    public function imageOci($tasks = [])
    {
        foreach ( $tasks as $key => $val ) {
            if (!isset( $val['dataId'] )) $tasks[$key]['dataId'] = uniqid();
        }
        return $this->post( '/green/image/scan',[
            "tasks"  => $tasks,
            "scenes" => [
                'oci'
            ]
        ] );
    }

    /**
     * 同步图像人脸识别
     * @param array $tasks
     * @return mixed
     */
    public function imageFace($tasks = [])
    {
        foreach ( $tasks as $key => $val ) {
            if (!isset( $val['dataId'] )) $tasks[$key]['dataId'] = uniqid();
        }
        return $this->post( '/green/image/scan',[
            "tasks"  => $tasks,
            "scenes" => [
                'sface'
            ]
        ] );
    }

    /**
     * 文本垃圾检测
     * @param array $tasks
     * @return array
     */
    public function textScan($tasks = [])
    {
        foreach ( $tasks as $key => $val ) {
            if (!isset( $val['dataId'] )) $tasks[$key]['dataId'] = uniqid();
        }
        return $this->post( '/green/text/scan',[
            "tasks"  => $tasks,
            "scenes" => [
                'antispam'
            ]
        ] );
    }

    /**
     * 关键词检测
     * @param array $tasks
     * @return array
     */
    public function keywordScan($tasks = [])
    {
        foreach ( $tasks as $key => $val ) {
            if (!isset( $val['dataId'] )) $tasks[$key]['dataId'] = uniqid();
        }
        return $this->post( '/green/text/scan',[
            'tasks'  => $tasks,
            'scenes' => [
                'keyword'
            ]
        ] );
    }
}