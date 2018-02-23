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
use App\Utils\Redis;
use Phalcon\Text;
use Xin\Traits\Common\InstanceTrait;
use App\Biz\Repository\User as UserRepository;
use App\Models\User as UserModel;

class User
{
    use InstanceTrait;

    /** @var UserModel $user */
    public $user;

    public function login($login, $password)
    {
        $user = UserRepository::getInstance()->getByLoginName($login);
        if (empty($user)) {
            // 用户不存在
            throw new BizException(ErrorCode::$ENUM_USER_NOT_EXSIT);
        }

        if (!Password::getInstance()->check($password, $user->password)) {
            throw new BizException(ErrorCode::$ENUM_USER_PASSWORD_ERROR);
        }

        $token = 'user:token:' . $user->id . ':' . Text::random(Text::RANDOM_ALNUM, 32);

        Redis::set($token, json_encode($user->toArray()), 3600 * 24);

        $result = [
            'token' => $token,
            'info' => $user
        ];

        return $result;
    }

    public function register($login, $password, $nickname)
    {
        $user = UserRepository::getInstance()->getByLoginName($login);
        if ($user) {
            throw new BizException(ErrorCode::$ENUM_USER_LOGINNAME_EXIST);
        }

        return UserRepository::getInstance()->create($login, $password, $nickname);
    }

    /**
     * @desc   根据TOKEN初始化用户信息
     * @author limx
     * @param $token
     * @return bool
     */
    public function initByToken($token)
    {
        $user = Redis::get($token);
        if (empty($user)) {
            return false;
        }

        $user = json_decode($user, true);
        if (empty($user['id'])) {
            return false;
        }

        $this->user = UserRepository::getInstance()->getById($user['id']);
        return true;
    }
}