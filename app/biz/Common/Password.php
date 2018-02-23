<?php
// +----------------------------------------------------------------------
// | Password.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Common;

use Xin\Traits\Common\InstanceTrait;

class Password
{
    use InstanceTrait;

    public function check($password, $encrypt)
    {
        return password_verify($this->confusion($password), $encrypt);
    }

    public function encrypt($password)
    {
        return password_hash($this->confusion($password), PASSWORD_DEFAULT);
    }

    private function confusion($password)
    {
        return 'DTM' . $password;
    }
}