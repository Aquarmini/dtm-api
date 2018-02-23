<?php
// +----------------------------------------------------------------------
// | ErrorCode.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Enums;

use Xin\Phalcon\Enum\Enum;

class ErrorCode extends Enum
{
    /**
     * @Message('系统错误')
     */
    public static $ENUM_SYSTEM_ERROR = 400;

    /**
     * @Message('入参不符')
     */
    public static $ENUM_PARAMS_ERROR = 401;

    /**
     * @Message('用户不存在或者密码错误')
     */
    public static $ENUM_USER_NOT_EXSIT = 1000;

    /**
     * @Message('用户不存在或者密码错误')
     */
    public static $ENUM_USER_PASSWORD_ERROR = 1001;
}
