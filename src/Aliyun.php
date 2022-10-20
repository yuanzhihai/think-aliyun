<?php

namespace yzh52521\Aliyun;

use InvalidArgumentException;
use think\helper\Arr;
use think\Manager;
use yzh52521\Aliyun\Services\CloudAuth;
use yzh52521\Aliyun\Services\CloudPush;
use yzh52521\Aliyun\Services\Dm;
use yzh52521\Aliyun\Services\Dns;
use yzh52521\Aliyun\Services\Domain;
use yzh52521\Aliyun\Services\Green;
use yzh52521\Aliyun\Services\HttpDns;
use yzh52521\Aliyun\Services\Jaq;
use yzh52521\Aliyun\Services\Live;
use yzh52521\Aliyun\Services\Cdn;
use yzh52521\Aliyun\Services\Mts;
use yzh52521\Aliyun\Services\Scdn;
use yzh52521\Aliyun\Services\Sms;
use yzh52521\Aliyun\Services\Vod;
use yzh52521\Aliyun\Services\Vpc;

class Aliyun extends Manager
{

    /**
     * 默认驱动
     * @return string|null
     */
    public function getDefaultDriver()
    {
        return $this->getConfig( 'default' );
    }

    /**
     * Get the aliyun service configuration.
     *
     * @param null|string $name
     * @param mixed $default
     */
    protected function getConfig(string $name = null,$default = null)
    {
        if (!is_null( $name )) {
            return $this->app->config->get( 'aliyun.services.'.$name,$default );
        }
        return $this->app->config->get( 'aliyun' );
    }

    protected function resolveConfig(string $name)
    {
        return $this->getServiceConfig( $name );
    }

    protected function resolveType(string $name)
    {
        return $this->getServiceConfig( $name );
    }

    public function getServiceConfig($service,$name = null,$default = null)
    {
        if ($config = $this->getConfig( $service )) {
            return Arr::get( $config,$name,$default );
        }
        throw new InvalidArgumentException( "Service [$service] not found." );
    }

    public function createDriver(string $name)
    {
        $config = $this->resolveType( $name );

        $driverMethod = 'create'.ucfirst( $config['driver'] ).'Service';

        $params = $this->resolveParams( $name );

        if (method_exists( $this,$driverMethod )) {
            return $this->$driverMethod( ...$params );
        }
        $class = $this->resolveClass( $config );

        return $this->app->invokeClass( $class,$params );
    }

    /**
     * driver()的别名
     * @param string|array $name 服务名
     */
    public function service($name = null)
    {
        return $this->driver( $name );
    }


    /**
     * 创建CDN服务
     * @param array $config
     * @return AliyunInterface
     */
    public function createCdnService(array $config)
    {
        return new Cdn( ['accessId' => $config['access_id'],'accessKey' => $config['access_key']] );
    }

    /**
     * 创建 CloudAuth 服务
     * @param array $config
     * @return CloudAuth
     */
    public function createCloudAuthService(array $config)
    {
        return new CloudAuth( [
            'accessId'  => $config['access_id'],
            'accessKey' => $config['access_key'],
        ] );
    }

    /**
     * 创建 CloudPush 服务
     * @param array $config
     * @return CloudPush
     */
    public function createCloudPushService(array $config)
    {
        return new CloudPush( [
            'accessId'  => $config['access_id'],
            'accessKey' => $config['access_key'],
            'regionId'  => $config['region_id'] ?? 'cn-hangzhou',
        ] );
    }


    /**
     * 创建 DNS 服务
     * @param array $config
     * @return Dns
     */
    public function createDnsService(array $config)
    {
        return new Dns( [
            'accessId'  => $config['access_id'],
            'accessKey' => $config['access_key'],
        ] );
    }

    /**
     * 创建 Domain 服务
     * @param array $config
     * @return Domain
     */
    public function createDomainService(array $config)
    {
        return new Domain( [
            'accessId'  => $config['access_id'],
            'accessKey' => $config['access_key'],
        ] );
    }


    /**
     * 创建 Dm 服务
     * @param array $config
     * @return Dm
     */
    public function createDmService(array $config)
    {
        return new Dm( [
            'accessId'  => $config['access_id'],
            'accessKey' => $config['access_key'],
        ] );
    }

    /**
     * 创建 Green 服务
     * @param array $config
     * @return Green
     */
    public function createGreenService(array $config)
    {
        return new Green( [
            'accessId'  => $config['access_id'],
            'accessKey' => $config['access_key'],
            'regionId'  => $config['region_id'] ?? 'cn-hangzhou'
        ] );
    }

    /**
     * 创建 HttpDns 服务
     * @param array $config
     * @return HttpDns
     */
    public function createHttpDnsService(array $config)
    {
        return new HttpDns( [
            'accessId'  => $config['access_id'],
            'accessKey' => $config['access_key'],
        ] );
    }

    /**
     * 创建 Jaq 服务
     * @param array $config
     * @return Jaq
     */
    public function createJaqService(array $config)
    {
        return new Jaq( [
            'accessId'  => $config['access_id'],
            'accessKey' => $config['access_key'],
            'regionId'  => $config['region_id'],
        ] );
    }

    /**
     * 创建 Live 服务
     * @param array $config
     * @return Live
     */
    public function createLiveService(array $config)
    {
        return new Live( [
            'accessId'  => $config['access_id'],
            'accessKey' => $config['access_key'],
        ] );
    }

    /**
     * 创建 Mns 服务
     * @param array $config
     * @return Mts
     */
    public function createMtsService(array $config)
    {
        return new Mts( [
            'accessId'  => $config['access_id'],
            'accessKey' => $config['access_key'],
        ] );
    }

    /**
     * 创建 Scdn 服务
     * @param array $config
     * @return Scdn
     */
    public function createScdnService(array $config)
    {
        return new Scdn( [
            'accessId'  => $config['access_id'],
            'accessKey' => $config['access_key'],
        ] );
    }

    /**
     * 创建 Sms 服务
     * @param array $config
     * @return Sms
     */
    public function createSmsService(array $config)
    {
        return new Sms( [
            'accessId'  => $config['access_id'],
            'accessKey' => $config['access_key'],
        ] );
    }

    /**
     * 创建 Vod 服务
     * @param array $config
     * @return Vod
     */
    public function createVodService(array $config)
    {
        return new Vod( [
            'accessId'  => $config['access_id'],
            'accessKey' => $config['access_key'],
        ] );
    }

    /**
     * 创建 Vpc 服务
     * @param array $config
     * @return Vpc
     */
    public function createVpcService(array $config)
    {
        return new Vpc( [
            'accessId'  => $config['access_id'],
            'accessKey' => $config['access_key'],
            'regionId'  => $config['region_id'],
        ] );
    }

}