<?php
// +----------------------------------------------------------------------
// | User.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Repository;

use Xin\Traits\Common\InstanceTrait;
use App\Models\User as UserModel;

class User
{
    use InstanceTrait;

    public function getByLogin($login)
    {
        return UserModel::findFirst([
            'conditions' => 'login = ?0',
            'bind' => $login
        ]);
    }
}