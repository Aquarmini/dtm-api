<?php
// +----------------------------------------------------------------------
// | Group.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz;

use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use Xin\Traits\Common\InstanceTrait;
use App\Biz\Repository\Group as GroupRepository;

class Group
{
    use InstanceTrait;

    public function listByUserId($pageIndex, $pageSize)
    {
        $user = User::getInstance()->user;
        $repository = GroupRepository::getInstance();
        $items = $repository->listByUserId($user->id, $pageIndex, $pageSize);
        $count = $repository->countByUserId($user->id);

        return [
            'items' => $items,
            'count' => $count
        ];
    }

    public function add($name)
    {
        $user = User::getInstance()->user;
        $repository = GroupRepository::getInstance();

        return $repository->add($user->id, $name);
    }

    public function save($id, $name)
    {
        $user = User::getInstance()->user;
        $repository = GroupRepository::getInstance();

        $group = $repository->getById($id);
        if ($group->userId !== $user->id) {
            throw new BizException(ErrorCode::$ENUM_GROUP_YOU_CAN_NOT_CHANGED);
        }

        $group->name = $name;

        return $group->save();
    }
}