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
use Phalcon\Mvc\Model\MetaDataInterface;
use Xin\Traits\Common\InstanceTrait;
use App\Biz\Repository\Group as GroupRepository;

class Group
{
    use InstanceTrait;

    public function listByUserId($pageIndex, $pageSize)
    {
        $user = User::getInstance()->user;
        $repository = GroupRepository::getInstance();
        $groups = $repository->listByUserId($user->id, $pageIndex, $pageSize);
        $count = $repository->countByUserId($user->id);

        $items = [];
        foreach ($groups as $v) {
            $item = $v->toArray();
            $item['finishTaskCount'] = $v->getFinishTaskCount();
            $item['taskCount'] = $v->getTaskCount();
            $items[] = $item;
        }

        return [
            'items' => $items,
            'count' => $count
        ];
    }

    public function info($groupId)
    {
        $user = User::getInstance()->user;
        $group = GroupRepository::getInstance()->getById($groupId);
        if (empty($group)) {
            throw new BizException(ErrorCode::$ENUM_GROUP_NOT_EXSIT);
        }

        if (empty($group->user)) {
            throw new BizException(ErrorCode::$ENUM_GROUP_NOT_HAVE_USER);
        }

        if ($group->user->id !== $user->id) {
            throw new BizException(ErrorCode::$ENUM_GROUP_NOT_HAVE_AUTHORITY);
        }

        return $group;
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

    public function delete($id)
    {
        $user = User::getInstance()->user;
        $repository = GroupRepository::getInstance();

        $group = $repository->getById($id);
        if ($group->userId !== $user->id) {
            throw new BizException(ErrorCode::$ENUM_GROUP_YOU_CAN_NOT_DELETED);
        }

        return $group->delete();
    }
}