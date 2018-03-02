<?php
// +----------------------------------------------------------------------
// | SystemCode.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Enums;

class SystemCode
{
    const HTTP_X_DTM_TOKEN = 'X-DTM-TOKEN';

    // 任务状态
    const TASK_STATUS_READY = 0; // 未开始
    const TASK_STATUS_WORKING = 1; // 进行中
    const TASK_STATUS_DELAY = 2; // 延期
    const TASK_STATUS_FINISH = 10; // 已完成
}
