<?php
// +----------------------------------------------------------------------
// | wechat.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------

$config = di('config')->wechat;

return [
    // 微信小程序
    'mini' => [
        'app_id' => $config->mini->app_id,
        'secret' => $config->mini->secret,

        // 下面为可选项
        // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
        'response_type' => 'array',

        'log' => [
            'level' => 'debug',
            'file' => get_current_log_dir() . 'wechat.log',
        ],
    ],
];
