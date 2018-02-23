<?php

namespace App\Controllers\Api;

use App\Biz\User;
use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use App\Common\Validators\UserLoginValidator;
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

}

