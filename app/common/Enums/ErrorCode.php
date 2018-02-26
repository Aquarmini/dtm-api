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

    /**
     * @Message('任务组保存失败！')
     */
    public static $ENUM_TASK_GROUP_SAVE_FAIL = 1006;

    /**
     * @Message('您没有删除此任务组的权限！')
     */
    public static $ENUM_GROUP_YOU_CAN_NOT_DELETED = 1007;

    /**
     * @Message('任务组删除失败！')
     */
    public static $ENUM_TASK_GROUP_DELETE_FAIL = 1008;

    /**
     * @Message('任务组不存在！')
     */
    public static $ENUM_GROUP_NOT_EXSIT = 1009;

    /**
     * @Message('新建任务失败！')
     */
    public static $ENUM_TASK_CREATE_FAIL = 1010;

    /**
     * @Message('越权操作！')
     */
    public static $ENUM_GROUP_NOT_HAVE_AUTHORITY = 1011;

    /**
     * @Message('任务不存在！')
     */
    public static $ENUM_TASK_NOT_EXIST = 1012;

    /**
     * @Message('任务组的所有人不存在！')
     */
    public static $ENUM_GROUP_NOT_HAVE_USER = 1013;

    /**
     * @Message('越权操作！')
     */
    public static $ENUM_TASK_NOT_HAVE_AUTHORITY = 1014;

    /**
     * @Message('任务状态更改失败！')
     */
    public static $ENUM_TASK_STATUS_CHANGED_FAIL = 1015;

    /**
     * @Message('用户授权信息不存在！')
     */
    public static $ENUM_OAUTH_NOT_EXIST = 1016;

    /**
     * @Message('用户授权登录失败！')
     */
    public static $ENUM_OAUTH_LOGIN_FAIL = 1017;

    /**
     * @Message('微信授权信息绑定出错！')
     */
    public static $ENUM_OAUTH_BIND_FAIL = 1018;
}
