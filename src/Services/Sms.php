<?php

namespace yzh52521\Aliyun\Services;

use GuzzleHttp\HandlerStack;
use yzh52521\Aliyun\BaseService;
use yzh52521\Aliyun\RpcStack;

/**
 * 短信服务
 *
 * 短信发送
 * @method SendSms( array $params ) 发送短信
 * @method SendBatchSms( array $params ) 批量发送短信
 *
 * 发送查询
 * @method QuerySendStatistics( array $params ) 查询短信发送统计信息
 * @method QuerySendDetails( array $params ) 查询短信发送详情
 *
 * 签名管理
 * @method AddSmsSign( array $params ) 申请短信签名
 * @method DeleteSmsSign( array $params ) 删除短信签名
 * @method ModifySmsSign( array $params ) 修改短信签名
 * @method QuerySmsSignList( array $params ) 查询短信签名列表
 * @method QuerySmsSign ( array $params ) 查询短信签名申请状态
 *
 * 模版管理
 * @method AddSmsTemplate( array $params ) 申请短信模板
 * @method DeleteSmsTemplate( array $params ) 删除短信模板
 * @method ModifySmsTemplate(array $params) 修改审核未通过的短信模板
 * @method QuerySmsTemplateList(array $params) 查询短信模板列表
 * @method QuerySmsTemplate(array $params) 查询短信模板的审核状态
 *
 * 短链管理
 * @method AddShortUrl(array $params) 创建短链
 * @method DeleteShortUrl(array $params) 删除短链
 * @method QueryShortUrl(array $params) 短链状态查询
 *
 * 标签管理
 * @method ListTagResources(array $params) 查询模板标签
 * @method TagResources(array $params) 添加模板标签
 * @method UntagResources(array $params) 删除模板标签
 *
 * 卡片短信
 * @method GetOSSInfoForCardTemplate(array $params) 获取OSS上传信息
 * @method GetMediaResourceId(array $params) 获取媒体资源ID
 * @method CreateCardSmsTemplate(array $params) 创建卡片短信模板
 * @method QueryCardSmsTemplate(array $params) 查询卡片短信模版状态
 * @method CheckMobilesCardSupport(array $params) 卡片短信能力校验
 * @method GetCardSmsLink(array $params) 获取卡片短信短链
 * @method SendCardSms(array $params) 发送卡片短信
 * @method SendBatchCardSms(array $params) 批量发送卡片短信
 * @method QueryCardSmsTemplateReport(array $params) 查询卡片短信发送详情
 *
 * @see https://help.aliyun.com/document_detail/419298.html
 */
class Sms extends BaseService
{
    /**
     * @var string 网关地址
     */
    public function getBaseUri()
    {
        return 'https://dysmsapi.aliyuncs.com';
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
            'version'      => '2017-05-25',
        ] );
        $stack->push( $middleware );
        return $stack;
    }
}