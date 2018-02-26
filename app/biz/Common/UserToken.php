<?php
// +----------------------------------------------------------------------
// | UserToken.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Common;

use App\Models\User;
use App\Utils\Redis;
use Phalcon\Text;
use Xin\Traits\Common\InstanceTrait;

class UserToken
{
    use InstanceTrait;

    public function login(User $user)
    {
        $token = 'user:token:' . $user->id . ':' . Text::random(Text::RANDOM_ALNUM, 32);

        Redis::set($token, json_encode($user->toArray()), 3600 * 24);

        return $token;
    }
}