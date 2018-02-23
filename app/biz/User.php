<?php
// +----------------------------------------------------------------------
// | User.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz;

use App\Biz\Common\Password;
use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use Xin\Traits\Common\InstanceTrait;
use App\Biz\Repository\User as UserRepository;

class User
{
    use InstanceTrait;

    public function login($login, $password)
    {
        $user = UserRepository::getInstance()->getByLogin($login);
        if (empty($user)) {
            // 用户不存在
            throw new BizException(ErrorCode::$ENUM_USER_NOT_EXSIT);
        }

        if (!Password::getInstance()->check($password, $user->password)) {
            throw new BizException(ErrorCode::$ENUM_USER_PASSWORD_ERROR);
        }

        return $user;
    }
}