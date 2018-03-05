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
use App\Biz\Common\UserToken;
use App\Biz\Common\Wechat;
use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use App\Utils\Redis;
use Phalcon\Text;
use Xin\Traits\Common\InstanceTrait;
use App\Biz\Repository\User as UserRepository;
use App\Biz\Repository\UserOauth as UserOauthRepository;
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

        $token = UserToken::getInstance()->login($user);

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

        // 刷新登录超时时间
        Redis::expire($token, 3600 * 24);

        $this->user = UserRepository::getInstance()->getById($user['id']);
        return true;
    }

    public function wechatLogin($code)
    {
        $app = Wechat::getInstance()->getMiniApplication();
        $session = $app->auth->session($code);

        if (empty($session['openid'])) {
            throw new BizException(ErrorCode::$ENUM_OAUTH_LOGIN_FAIL);
        }

        $openid = $session['openid'];
        $oauth = UserOauthRepository::getInstance()->findByOpenId($openid);
        if (empty($oauth) || empty($oauth->user)) {
            throw new BizException(ErrorCode::$ENUM_OAUTH_NOT_EXIST);
        }

        $user = $oauth->user;

        $token = UserToken::getInstance()->login($user);

        return [
            'token' => $token,
            'info' => $user->toArray()
        ];
    }

    public function bindWechat($code)
    {
        $app = Wechat::getInstance()->getMiniApplication();
        $session = $app->auth->session($code);

        if (empty($session['openid'])) {
            throw new BizException(ErrorCode::$ENUM_OAUTH_LOGIN_FAIL);
        }

        $openid = $session['openid'];
        $user = User::getInstance()->user;

        return UserOauthRepository::getInstance()->bind($user->id, $openid);
    }
}
