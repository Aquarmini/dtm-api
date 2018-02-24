<?php

namespace App\Controllers\Api;

use App\Biz\Task;
use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use App\Common\Validators\PaginationValidator;
use App\Common\Validators\TaskAddValidator;
use App\Common\Validators\TaskIndexValidator;
use App\Controllers\Controller;
use App\Utils\Request;
use App\Utils\Response;

class TaskController extends Controller
{
    /**
     * @desc   新增任务
     * @author limx
     * @Middleware('auth')
     * @return \Phalcon\Http\Response
     * @throws BizException
     */
    public function addAction()
    {
        $validator = new TaskAddValidator();
        if ($validator->validate(Request::get())->valid()) {
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $groupId = $validator->getValue('groupId');
        $detail = $validator->getValue('detail');

        $result = Task::getInstance()->add($groupId, $detail);
        return Response::success($result);
    }

    /**
     * @desc   任务列表
     * @author limx
     * @Middleware('auth')
     * @return \Phalcon\Http\Response
     * @throws BizException
     */
    public function indexAction()
    {
        $validator = new TaskIndexValidator();
        if ($validator->validate(Request::get())->valid()) {
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $pageIndex = $validator->getValue('pageIndex');
        $pageSize = $validator->getValue('pageSize');
        $groupId = $validator->getValue('groupId');

        $result = Task::getInstance()->index($groupId, $pageIndex, $pageSize);
        return Response::success($result);
    }

}

