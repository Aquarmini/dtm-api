<?php

namespace App\Controllers\Api;

use App\Biz\User;
use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use App\Common\Validators\CodeValidator;
use App\Common\Validators\UserLoginValidator;
use App\Common\Validators\UserRegisterValidator;
use App\Controllers\Controller;
use App\Utils\Request;
use App\Utils\Response;

class UserController extends Controller
{

    public function loginAction()
    {
        $validator = new UserLoginValidator();
        if ($validator->validate(Request::get())->valid()) {
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $login = $validator->getValue('login');
        $password = $validator->getValue('password');

        $user = User::getInstance()->login($login, $password);

        return Response::success($user);
    }

    public function registerAction()
    {
        $validator = new UserRegisterValidator();
        if ($validator->validate(Request::get())->valid()) {
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $login = $validator->getValue('login');
        $password = $validator->getValue('password');
        $nickname = $validator->getValue('nickname');

        $user = User::getInstance()->register($login, $password, $nickname);

        return Response::success($user);
    }

    /**
     * @desc   获取用户信息
     * @author limx
     * @Middleware('auth')
     * @return \Phalcon\Http\Response
     */
    public function infoAction()
    {
        return Response::success(User::getInstance()->user);
    }

    /**
     * @desc   根据微信Code登录
     * @author limx
     * @return \Phalcon\Http\Response
     */
    public function wechatLoginAction()
    {
        $validator = new CodeValidator();
        if ($validator->validate(Request::get())->valid()) {
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $code = $validator->getValue('code');

        $result = User::getInstance()->wechatLogin($code);

        return Response::success($result);
    }

    /**
     * @desc   绑定微信openid
     * @author limx
     * @Middleware('auth')
     * @return \Phalcon\Http\Response
     */
    public function bindWechatAction()
    {
        $validator = new CodeValidator();
        if ($validator->validate(Request::get())->valid()) {
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $code = $validator->getValue('code');

        $result = User::getInstance()->bindWechat($code);
        if ($result) {
            return Response::success();
        }

        return Response::fail(ErrorCode::$ENUM_OAUTH_BIND_FAIL);
    }

}

