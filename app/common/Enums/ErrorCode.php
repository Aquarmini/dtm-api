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
     * @Message('TOKEN已失效')
     */
    public static $ENUM_TOKEN_INVALIAD = 700;

    /**
     * @Message('用户不存在或者密码错误')
     */
    public static $ENUM_USER_NOT_EXSIT = 1000;

    /**
     * @Message('用户不存在或者密码错误')
     */
    public static $ENUM_USER_PASSWORD_ERROR = 1001;

    /**
     * @Message('用户登录名已存在，请更换其他登录名')
     */
    public static $ENUM_USER_LOGINNAME_EXIST = 1002;

    /**
     * @Message('用户注册失败！')
     */
    public static $ENUM_USER_REGISTER_FAIL = 1003;

    /**
     * @Message('任务组新建失败！')
     */
    public static $ENUM_TASK_GROUP_CREATE_FAIL = 1004;

    /**
     * @Message('您没有修改此任务组的权限！')
     */
    public static $ENUM_GROUP_YOU_CAN_NOT_CHANGED = 1005;
}
