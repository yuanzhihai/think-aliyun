<?php

namespace yzh52521\Aliyun\Services;

use GuzzleHttp\HandlerStack;
use yzh52521\Aliyun\BaseService;
use yzh52521\Aliyun\RpcStack;

/**
 * Vpc 弹性Ip
 * 专有网络（VPC）
 * @method CreateVpc( array $params ) 调用CreateVpc接口创建一个专有网络VPC（Virtual Private Cloud）
 * @method DeleteVpc( array $params )  调用DeleteVpc接口删除一个专有网络VPC（Virtual Private Cloud）。
 * @method DescribeVpcs( array $params ) 调用DescribeVpcs接口查询指定VPC。
 * @method ModifyVpcAttribute( array $params ) 调用ModifyVpcAttribute接口修改指定VPC的名称和描述信息。
 * @method DescribeVpcAttribute( array $params ) 调用DescribeVpcAttribute接口查询指定VPC的配置信息。
 * @method GrantInstanceToCen( array $params ) 调用GrantInstanceToCen为云企业网实例授权。
 * @method RevokeInstanceFromCen( array $params ) 调用RevokeInstanceFromCen撤销网络实例对指定云企业网实例的授权。
 * @method DisableVpcClassicLink( array $params ) 调用DisableVpcClassicLink关闭VPC的ClassicLink功能。
 * @method EnableVpcClassicLink ( array $params ) 调用EnableVpcClassicLink开启VPC的ClassicLink功能。
 * @method DeletionProtection( array $params ) 调用DeletionProtection设置实例删除保护功能。
 * @method AssociateVpcCidrBlock ( array $params ) 调用AssociateVpcCidrBlock接口为VPC添加附加网段。
 * @method UnassociateVpcCidrBlock( array $params ) 调用UnassociateVpcCidrBlock接口删除VPC的附加网段。
 * @method DescribeGrantRulesToCen( array $params ) 调用DescribeGrantRulesToCen查询指定网络实例（VPC、VBR或CCN）的云企业网跨账号授权信息。
 * @method MoveResourceGroup( array $params ) 调用MoveResourceGroup接口修改云资源所属的资源组。
 * @method AllocateVpcIpv6Cidr( array $params ) 调用AllocateVpcIpv6Cidr接口预留指定的IPv6地址段。
 *
 * 路由器
 * @method DescribeVRouters( array $params ) 调用DescribeVRouters接口查询指定地域的路由器列表。
 * @method ModifyVRouterAttribute( array $params ) 调用ModifyVRouterAttribute接口修改路由器的名称和描述信息。
 *
 * 交换机
 *
 * 路由表
 *
 * 前缀列表
 *
 * DHCP选项集
 *
 * 流日志
 *
 * 网络 ACL
 *
 * 高可用虚拟IP
 *
 * 流量镜像
 *
 * 弹性公网IP
 *
 * …………
 *
 * @see https://help.aliyun.com/document_detail/34960.html
 */
class Vpc extends BaseService
{
    /**
     * @return string
     */
    public function getBaseUri()
    {
        return 'https://vpc.aliyuncs.com';
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
            'version'      => '2016-04-28',
        ] );
        $stack->push( $middleware );
        return $stack;
    }

}