<?php
// +----------------------------------------------------------------------
// | Task.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz;

use App\Common\Enums\ErrorCode;
use App\Common\Enums\SystemCode;
use App\Common\Exceptions\BizException;
use Xin\Traits\Common\InstanceTrait;
use App\Biz\Repository\Group as GroupRepository;
use App\Biz\Repository\Task as TaskRepository;

class Task
{
    use InstanceTrait;

    public function add($groupId, $detail)
    {
        $user = User::getInstance()->user;
        $group = GroupRepository::getInstance()->getById($groupId);
        if (empty($group)) {
            throw new BizException(ErrorCode::$ENUM_GROUP_NOT_EXSIT);
        }

        if ($group->userId !== $user->id) {
            throw new BizException(ErrorCode::$ENUM_GROUP_YOU_CAN_NOT_CHANGED);
        }

        $result = TaskRepository::getInstance()->add($groupId, $detail);
        if (!$result) {
            throw new BizException(ErrorCode::$ENUM_TASK_CREATE_FAIL);
        }

        return ['info' => $result];
    }

    public function index($groupId, $pageIndex = 0, $pageSize = 10)
    {
        $user = User::getInstance()->user;

        $group = GroupRepository::getInstance()->getById($groupId);
        if (empty($group)) {
            throw new BizException(ErrorCode::$ENUM_GROUP_NOT_EXSIT);
        }

        if ($group->userId !== $user->id) {
            throw new BizException(ErrorCode::$ENUM_GROUP_NOT_HAVE_AUTHORITY);
        }

        $repository = TaskRepository::getInstance();
        $tasks = $repository->index($groupId, $pageIndex, $pageSize);
        $count = $repository->count($groupId);

        return [
            'items' => $tasks,
            'total' => $count
        ];
    }

    public function status($taskId, $status)
    {
        $task = TaskRepository::getInstance()->getById($taskId);
        if (empty($task)) {
            throw new BizException(ErrorCode::$ENUM_TASK_NOT_EXIST);
        }

        $group = $task->group;
        if (empty($group)) {
            throw new BizException(ErrorCode::$ENUM_GROUP_NOT_EXSIT);
        }

        $user = $group->user;
        if (empty($user)) {
            throw new BizException(ErrorCode::$ENUM_GROUP_NOT_HAVE_USER);
        }

        if (User::getInstance()->user->id !== $user->id) {
            throw new BizException(ErrorCode::$ENUM_TASK_NOT_HAVE_AUTHORITY);
        }

        if ($status === SystemCode::TASK_STATUS_WORKING) {
            $task->beginAt = date('Y-m-d H:i:s');
        } elseif ($status === SystemCode::TASK_STATUS_FINISH) {
            $task->endAt = date('Y-m-d H:i:s');
        }
        $task->status = $status;
        return $task->save();
    }

    public function dailyCount($pageIndex, $pageSize)
    {
        $user = User::getInstance()->user;

        $repository = GroupRepository::getInstance();
        $groups = $repository->listByUserId($user->id, $pageIndex, $pageSize);

        $items = [];
        foreach ($groups as $v) {
            $item = $v->toArray();
            $item['finishTaskCount'] = $v->getFinishTaskCount();
            $item['taskCount'] = $v->getTaskCount();
            $items[] = $item;
        }

        $total = $repository->countByUserId($user->id);

        return [
            'items' => $items,
            'total' => $total
        ];
    }
}