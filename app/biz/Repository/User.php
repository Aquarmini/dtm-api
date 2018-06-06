<?php
// +----------------------------------------------------------------------
// | User.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Repository;

use App\Biz\Common\Password;
use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use Xin\Traits\Common\InstanceTrait;
use App\Models\User as UserModel;

class User
{
    use InstanceTrait;

    /**
     * @desc   根据登录名获取用户
     * @author limx
     * @param $login
     * @return UserModel|\Phalcon\Mvc\Model\ResultInterface
     */
    public function getByLoginName($login)
    {
        return UserModel::findFirst([
            'conditions' => 'login = ?0',
            'bind' => [$login]
        ]);
    }

    /**
     * @desc   根据用户ID获取用户
     * @author limx
     * @param $id
     * @return UserModel|\Phalcon\Mvc\Model\ResultInterface
     */
    public function getById($id)
    {
        return UserModel::findFirst($id);
    }

    /**
     * @desc   新建用户
     * @author limx
     * @param $login
     * @param $password
     * @param $nickname
     * @return UserModel
     * @throws BizException
     */
    public function create($login, $password, $nickname)
    {
        $user = new UserModel();
        $user->login = $login;
        $user->password = Password::getInstance()->encrypt($password);
        $user->nickname = $nickname;
        if (!$user->save()) {
            throw new BizException(ErrorCode::$ENUM_USER_REGISTER_FAIL);
        }
        return $user;
    }
}
