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
use App\Models\User;
use Tests\HttpTestCase;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class TaskTest extends HttpTestCase
{
    public function testTaskAdd()
    {
        $result = $this->post('/group/index', [
            'pageIndex' => 0,
            'pageSize' => 10
        ]);

        $this->assertTrue($result['success']);
        if ($items = $result['data']['items']) {
            if (!empty($items)) {
                $group = $items[0];
                $id = $group['id'];

                $result = $this->post('/task/add', [
                    'groupId' => $id,
                    'detail' => '测试任务' . uniqid()
                ]);

                $this->assertTrue($result['success']);
            }
        }
    }

    public function testTaskIndex()
    {
        $result = $this->post('/group/index', [
            'pageIndex' => 0,
            'pageSize' => 10
        ]);

        $this->assertTrue($result['success']);
        if ($items = $result['data']['items']) {
            if (!empty($items)) {
                $group = $items[0];
                $id = $group['id'];

                $result = $this->post('/task/index', [
                    'groupId' => $id,
                    'pageIndex' => 0,
                    'pageSize' => 10
                ]);

                dd($result);

                $this->assertTrue($result['success']);
            }
        }
    }
}
