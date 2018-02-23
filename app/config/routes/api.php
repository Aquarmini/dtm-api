<?php

// 用户登录
$router->add('/user/login', 'App\\Controllers\\Api\\User::login');
// 用户注册
$router->add('/user/register', 'App\\Controllers\\Api\\User::register');

// ************************** 用户权限验证 **************************

// 用户信息
$router->add('/user/info', 'App\\Controllers\\Api\\User::info');
// 我的任务组
$router->add('/group/index', 'App\\Controllers\\Api\\Group::index');
// 新增任务组
$router->add('/group/add', 'App\\Controllers\\Api\\Group::add');
// 新增任务组
$router->add('/group/save', 'App\\Controllers\\Api\\Group::save');
