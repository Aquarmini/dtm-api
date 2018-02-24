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
}