<?php
// +----------------------------------------------------------------------
// | 基础测试类 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Api;

use App\Biz\Common\Password;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class FuncTest extends UnitTestCase
{
    public function testPassword()
    {
        $password = Password::getInstance()->encrypt('910123');

        $this->assertTrue(Password::getInstance()->check('910123', $password));
    }
}
