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
            'conditions' => 'user_id = ?0',
            'bind' => [$userId],
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
            'conditions' => 'user_id = ?0',
            'bind' => [$userId],
        ]);
    }
}