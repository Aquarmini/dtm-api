<?php
// +----------------------------------------------------------------------
// | Group.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Repository;

use Xin\Traits\Common\InstanceTrait;
use App\Models\Group as GroupModel;

class Group
{
    use InstanceTrait;

    /**
     * @desc   根据用户ID分页获取数据
     * @author limx
     * @param     $userId
     * @param int $pageIndex
     * @param int $pageSize
     * @return GroupModel|GroupModel[]|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public function listByUserId($userId, $pageIndex = 0, $pageSize = 10)
    {
        $start = $pageIndex * $pageSize;

        return GroupModel::find([
            'conditions' => 'userId = ?0 AND isDeleted = 0',
            'bind' => [$userId],
            'order' => 'id DESC',
            'offset' => $start,
            'limit' => $pageSize
        ]);
    }

    /**
     * @desc   获取某用户任务组总数
     * @author limx
     * @param $userId
     * @return mixed
     */
    public function countByUserId($userId)
    {
        return GroupModel::count([
            'conditions' => 'userId = ?0 AND isDeleted = 0',
            'bind' => [$userId],
        ]);
    }

    /**
     * @desc   新增任务组
     * @author limx
     * @param $userId
     * @param $name
     * @return bool|integer
     */
    public function add($userId, $name)
    {
        $group = new GroupModel();
        $group->userId = $userId;
        $group->name = $name;
        if ($group->save()) {
            return $group->id;
        }
        return false;
    }

    /**
     * @desc   通过组ID获取组信息
     * @author limx
     * @param $id
     * @return GroupModel|\Phalcon\Mvc\Model\ResultInterface
     */
    public function getById($id)
    {
        return GroupModel::findFirst($id);
    }
}