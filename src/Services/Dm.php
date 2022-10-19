<?php

namespace yzh52521\Aliyun\Services;

use GuzzleHttp\HandlerStack;
use yzh52521\Aliyun\BaseService;
use yzh52521\Aliyun\RpcStack;

/**
 * 邮件推送
 *
 * 发送邮件
 * @method SingleSendMail(array $params) 单一发信接口，支持发送触发和批量邮件
 * @method BatchSendMail(array $params) 批量发信接口，支持通过调用模板的方式发送批量邮件
 *
 * 发信地址
 * @method CreateMailAddress(array $params) 创建发信地址
 * @method DeleteMailAddress(array $params) 删除发信地址
 * @method ModifyMailAddress(array $params) 设置发信地址SMTP密码和回信地址
 * @method QueryMailAddressByParam(array $params) 查询发信地址列表
 *
 * 收件地址
 * @method CreateReceiver(array $params) 创建收件人列表
 * @method DeleteReceiver(array $params) 删除收件人列表
 * @method DeleteReceiverDetail(array $params) 删除单个收件人
 * @method QueryReceiverDetail(array $params) 查询某个收件人列表详情
 * @method QueryReceiverByParam(array $params) 查询收件人列表
 * @method SaveReceiverDetail(array $params) 创建单个收件人
 *
 * Tag标签
 * @method CreateTag(array $params) 创建标签
 * @method DeleteTag(array $params) 删除标签
 * @method ModifyTag(array $params) 修改标签
 * @method QueryTagByParam(array $params) 获取Tag
 *
 *
 *
 * @see https://help.aliyun.com/document_detail/29434.html
 */
class Dm extends BaseService
{
    /**
     * @return string
     */
    public function getBaseUri()
    {
        return 'https://dm.aliyuncs.com';
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
            'version'      => '2015-11-23',
        ] );
        $stack->push( $middleware );
        return $stack;
    }
}