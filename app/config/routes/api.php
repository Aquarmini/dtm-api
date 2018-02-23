<?php

// 用户登录
$router->add('/user/login', 'App\\Controllers\\Api\\User::login');
// 用户注册
$router->add('/user/register', 'App\\Controllers\\Api\\User::register');
