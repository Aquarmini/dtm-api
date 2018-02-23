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
use Tests\HttpTestCase;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class UserTest extends HttpTestCase
{
    public function testRegister()
    {
        $data = [
            'login' => 'limx',
            'password' => md5('910123'),
            'nickname' => '李铭昕'
        ];

        $result = $this->post('/user/register', $data);

        if ($result['success']) {
            $this->assertEquals('limx', $result['data']['login']);
        } else {
            $this->assertEquals(1002, $result['errorCode']);
        }
    }

    public function testLogin()
    {
        $data = [
            'login' => 'limx',
            'password' => md5('910123'),
        ];

        $result = $this->post('/user/login', $data);

        $this->assertTrue($result['success']);
        $token = $result['data']['token'];
        $this->setUserToken($token);

        $this->assertEquals($token, $this->getUserToken());
    }

    public function testInfo()
    {
        $result = $this->post('/user/info');
        $this->assertTrue($result['success']);
        $this->assertEquals('limx', $result['data']['login']);
    }
}
