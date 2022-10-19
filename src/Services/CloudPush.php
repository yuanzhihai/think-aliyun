<?php

namespace yzh52521\Aliyun\Services;

use GuzzleHttp\HandlerStack;
use yzh52521\Aliyun\BaseService;
use yzh52521\Aliyun\RpcStack;

/**
 * 移动推送服务
 *
 * App 相关
 * @method listSummaryApps() APP概览列表
 *
 * 推送相关
 * @method pushMessageToAndroid( array $params ) 推消息给Android设备
 * @method pushMessageToiOS( array $params ) 推消息给iOS设备
 * @method pushNoticeToAndroid( array $params ) 推通知给Android设备
 * @method pushNoticeToiOS( array $params ) 推通知给iOS设备
 * @method push( array $params ) 推送高级接口
 * @method cancelPush( array $params ) 取消定时推送任务
 *
 * 查询相关
 * @method listPushRecords( array $params ) 查询推送列表
 * @method queryPushStatByApp( array $params ) APP维度推送统计
 * @method queryPushStatByMsg( array $params ) 任务维度推送统计
 * @method queryDeviceStat( array $params ) 设备新增与留存
 * @method queryUniqueDeviceStat( array $params ) 去重设备统计
 * @method queryDeviceInfo( array $params ) 查询设备详情
 * @method checkDevices( array $params ) 批量检查设备有效性
 *
 * TAG相关
 * @method bindTag( array $params ) 绑定TAG
 * @method queryTags( array $params ) 查询TAG
 * @method unbindTag( array $params ) 解绑TAG
 * @method listTags( array $params ) TAG列表
 * @method removeTag( array $params ) 删除TAG
 *
 * Alias相关
 * @method bindAlias( array $params ) 绑定别名
 * @method queryAliases( array $params ) 查询别名
 * @method unbindAlias( array $params ) 解绑别名
 *
 * 账号相关
 * @method QueryDevicesByAccount(array $params) 查询设备列表
 *
 *
 * @see https://help.aliyun.com/document_detail/48038.html
 */
class CloudPush extends BaseService
{
    /**
     * @var string 区域ID
     */
    protected $regionId = 'cn-hangzhou';

    /**
     * @return string
     */
    public function getBaseUri()
    {
        return 'https://cloudpush.aliyuncs.com';
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
            'regionId'     => $this->regionId,
            'version'      => '2017-08-25',
        ] );
        $stack->push( $middleware );
        return $stack;
    }
}