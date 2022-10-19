<?php

namespace yzh52521\Aliyun;

class AliyunService extends \think\Service
{
    public function register()
    {
        $this->app->bind( 'aliyun',function () {
            return new Aliyun( $this->app );
        } );
    }
}