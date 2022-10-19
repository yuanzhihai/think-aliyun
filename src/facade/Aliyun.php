<?php

namespace yzh52521\Aliyun\facade;

use think\Facade;

/**
 * Class Aliyun
 * @package think\facade
 * @mixin \yzh52521\Aliyun\Aliyun
 * @method static service(string $name = null) ,null|string
 * @method static mixed getConfig(null|string $name = null, mixed $default = null) 获取配置
 * @method static array getServiceConfig(string $disk, null $name = null, null $default = null) 获取服务配置
 * @method static string|null getDefaultDriver() 默认驱动
 */
class Aliyun extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeClass()
    {
        return 'aliyun';
    }
}