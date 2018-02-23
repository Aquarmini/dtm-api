<?php
// +----------------------------------------------------------------------
// | AuthMiddleware.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Middleware;

use App\Biz\User;
use App\Common\Enums\ErrorCode;
use App\Common\Enums\SystemCode;
use App\Common\Exceptions\BizException;
use Closure;
use Xin\Phalcon\Middleware\Middleware;

class AuthMiddleware extends Middleware
{
    public function handle($request, Closure $next)
    {
        if (!$this->request->hasHeader(SystemCode::HTTP_X_DTM_TOKEN)) {
            throw new BizException(ErrorCode::$ENUM_TOKEN_INVALIAD);
        }

        $token = $this->request->getHeader(SystemCode::HTTP_X_DTM_TOKEN);
        if (!User::getInstance()->initByToken($token)) {
            throw new BizException(ErrorCode::$ENUM_TOKEN_INVALIAD);
        }

        return $next($request);
    }
}
