<?php

namespace App\Controllers\Api;

use App\Biz\Task;
use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use App\Common\Validators\PaginationValidator;
use App\Common\Validators\TaskAddValidator;
use App\Common\Validators\TaskIdValidator;
use App\Common\Validators\TaskIndexValidator;
use App\Common\Validators\TaskStatusValidator;
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

    /**
     * @desc   更改任务状态
     * @author limx
     * @Middleware('auth')
     * @return \Phalcon\Http\Response
     */
    public function statusAction()
    {
        $validator = new TaskStatusValidator();
        if ($validator->validate(Request::get())->valid()) {
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $taskId = $validator->getValue('taskId');
        $status = $validator->getValue('status');

        if (Task::getInstance()->status($taskId, $status)) {
            return Response::success();
        }
        return Response::fail(ErrorCode::$ENUM_TASK_STATUS_CHANGED_FAIL);
    }

    /**
     * @desc   每日任务统计
     * @author limx
     * @Middleware('auth')
     * @return \Phalcon\Http\Response
     */
    public function dailyCountAction()
    {
        $validator = new PaginationValidator();
        if ($validator->validate(Request::get())->valid()) {
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $pageIndex = $validator->getValue('pageIndex');
        $pageSize = $validator->getValue('pageSize');

        $result = Task::getInstance()->dailyCount($pageIndex, $pageSize);

        return Response::success($result);
    }

    /**
     * @desc   任务删除
     * @author limx
     * @Middleware('auth')
     * @return \Phalcon\Http\Response
     */
    public function deleteAction()
    {
        $validator = new TaskIdValidator();
        if ($validator->validate(Request::get())->valid()) {
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $taskId = $validator->getValue('taskId');

        $result = Task::getInstance()->delete($taskId);
        if ($result) {
            return Response::success();
        }
        return Response::fail(ErrorCode::$ENUM_TASK_DELETE_FAIL);
    }
}
