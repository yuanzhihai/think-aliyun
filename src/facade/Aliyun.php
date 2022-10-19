<?php

namespace yzh52521\Aliyun\facade;

use think\Facade;

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