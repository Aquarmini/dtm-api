<?php
// +----------------------------------------------------------------------
// | Wechat.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Common;

use EasyWeChat\Factory;
use Xin\Traits\Common\InstanceTrait;

class Wechat
{
    use InstanceTrait;

    protected $miniApplication;

    /**
     * @desc   获取小程序App
     * @author limx
     * @return \EasyWeChat\MiniProgram\Application
     */
    public function getMiniApplication()
    {
        if (isset($miniApplication) && $miniApplication instanceof \EasyWeChat\MiniProgram\Application) {
            return $miniApplication;
        }

        $config = di('configCenter')->get('wechat');
        return $this->miniApplication = Factory::miniProgram($config->mini->toArray());
    }
}
