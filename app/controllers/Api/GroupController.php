<?php

namespace App\Controllers\Api;

use App\Biz\Group;
use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use App\Common\Validators\GroupAddValidator;
use App\Common\Validators\GroupDeleteValidator;
use App\Common\Validators\GroupIndexValidator;
use App\Common\Validators\GroupSaveValidator;
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

        $pageIndex = $validator->getValue('pageIndex');
        $pageSize = $validator->getValue('pageSize');

        $result = Group::getInstance()->listByUserId($pageIndex, $pageSize);

        return Response::success($result);
    }

    /**
     * @desc   新建任务组
     * @author limx
     * @Middleware('auth')
     * @return \Phalcon\Http\Response
     */
    public function addAction()
    {
        $validator = new GroupAddValidator();
        if ($validator->validate(Request::get())->valid()) {
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $name = $validator->getValue('name');

        $id = Group::getInstance()->add($name);
        if ($id > 0) {
            return Response::success([
                'id' => $id
            ]);
        }
        return Response::fail(ErrorCode::$ENUM_TASK_GROUP_CREATE_FAIL);
    }

    /**
     * @desc   新建任务组
     * @author limx
     * @Middleware('auth')
     * @return \Phalcon\Http\Response
     */
    public function saveAction()
    {
        $validator = new GroupSaveValidator();
        if ($validator->validate(Request::get())->valid()) {
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $name = $validator->getValue('name');
        $groupId = $validator->getValue('groupId');

        $result = Group::getInstance()->save($groupId, $name);
        if ($result) {
            return Response::success();
        }
        return Response::fail(ErrorCode::$ENUM_TASK_GROUP_SAVE_FAIL);
    }

    /**
     * @desc   删除任务组
     * @author limx
     * @Middleware('auth')
     * @return \Phalcon\Http\Response
     */
    public function deleteAction()
    {
        $validator = new GroupDeleteValidator();
        if ($validator->validate(Request::get())->valid()) {
            throw new BizException(ErrorCode::$ENUM_PARAMS_ERROR, $validator->getErrorMessage());
        }

        $groupId = $validator->getValue('groupId');
        $result = Group::getInstance()->delete($groupId);

        if ($result) {
            return Response::success();
        }
        return Response::fail(ErrorCode::$ENUM_TASK_GROUP_DELETE_FAIL);
    }

}

