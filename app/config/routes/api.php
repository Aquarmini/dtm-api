<?php

// 用户登录
$router->add('/user/login', 'App\\Controllers\\Api\\User::login');
// 用户注册
$router->add('/user/register', 'App\\Controllers\\Api\\User::register');
// 微信自动登录
$router->add('/user/login/wechat', 'App\\Controllers\\Api\\User::wechatLogin');
// ************************** 用户权限验证 **************************

// 用户信息
$router->add('/user/info', 'App\\Controllers\\Api\\User::info');
// 绑定微信授权
$router->add('/user/bind/wechat', 'App\\Controllers\\Api\\User::bindWechat');
// 我的任务组
$router->add('/group/index', 'App\\Controllers\\Api\\Group::index');
// 我的任务组详情
$router->add('/group/info', 'App\\Controllers\\Api\\Group::info');
// 新增任务组
$router->add('/group/add', 'App\\Controllers\\Api\\Group::add');
// 保存任务组
$router->add('/group/save', 'App\\Controllers\\Api\\Group::save');
// 删除任务组
$router->add('/group/delete', 'App\\Controllers\\Api\\Group::delete');
// 新增某个任务
$router->add('/task/add', 'App\\Controllers\\Api\\Task::add');
// 任务列表
$router->add('/task/index', 'App\\Controllers\\Api\\Task::index');
// 修改任务状态
$router->add('/task/status', 'App\\Controllers\\Api\\Task::status');