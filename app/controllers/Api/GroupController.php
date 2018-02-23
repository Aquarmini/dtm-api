<?php

namespace App\Controllers\Api;

use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use App\Common\Validators\GroupIndexValidator;
use App\Controllers\Controller;
use App\Utils\Request;
use App\Utils\Response;

class GroupController extends Controller
{
    /**
     * @desc   我的任务组列表
     * @author limx
     * @Middleware('auth')
     * @return \Phalcon\Http\Response
     */
    public function indexAction()
    {
        $validator = new GroupIndexValidator();
        if ($validator->validate(Request::get())->valid()) {
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }


        return Response::success();
    }

}

