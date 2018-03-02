<?php
// +----------------------------------------------------------------------
// | helper.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------

function get_current_log_dir()
{
    $date = date('Ymd');
    $dir = di('config')->application->logDir;
    return $dir . $date . '/';
}
