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
class GroupTest extends HttpTestCase
{
    public function testGroupIndex()
    {
        $result = $this->post('/group/index', [
            'pageIndex' => 0,
            'pageSize' => 10
        ]);
        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('items', $result['data']);
        $this->assertArrayHasKey('count', $result['data']);
    }

    public function testGroupAdd()
    {
        $result = $this->post('/group/add', [
            'name' => '测试组',
        ]);
        $this->assertTrue($result['success']);
    }
}
