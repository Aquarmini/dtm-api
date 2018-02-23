<?php

namespace App\Controllers\Api;

use App\Biz\User;
use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
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
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR);
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
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR);
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

}

