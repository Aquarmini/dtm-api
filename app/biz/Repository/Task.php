<?php
// +----------------------------------------------------------------------
// | Task.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Repository;

use Xin\Traits\Common\InstanceTrait;
use App\Models\Task as TaskModel;

class Task
{
    use InstanceTrait;

    /**
     * @desc   根据ID获取任务
     * @author limx
     * @param $taskId
     * @return TaskModel|\Phalcon\Mvc\Model\ResultInterface
     */
    public function getById($taskId)
    {
        return TaskModel::findFirst($taskId);
    }

    /**
     * @desc   新增任务
     * @author limx
     * @param $groupId
     * @param $detail
     * @return TaskModel|bool
     */
    public function add($groupId, $detail)
    {
        $task = new TaskModel();
        $task->groupId = $groupId;
        $task->detail = $detail;
        if ($task->save()) {
            return $task;
        }
        return false;
    }

    /**
     * @desc   返回任务列表
     * @author limx
     * @param     $groupId
     * @param int $pageIndex
     * @param int $pageSize
     * @return TaskModel|TaskModel[]|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public function index($groupId, $pageIndex = 0, $pageSize = 10)
    {
        return TaskModel::find([
            'conditions' => 'groupId = ?0',
            'bind' => [$groupId],
            'offset' => $pageSize * $pageIndex,
            'limit' => $pageSize
        ]);
    }

    /**
     * @desc   返回任务总数
     * @author limx
     * @param $groupId
     * @return mixed
     */
    public function count($groupId)
    {
        return TaskModel::count([
            'conditions' => 'groupId = ?0',
            'bind' => [$groupId],
        ]);
    }
}