<?php
// +----------------------------------------------------------------------
// | Chat.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz;

use App\Common\Enums\ErrorCode;
use limx\Support\Arr;
use Xin\Traits\Common\InstanceTrait;
use swoole_websocket_server;
use App\Common\Exceptions\BizException;
use Exception;

class Chat
{
    use InstanceTrait;

    protected $server;

    public function handle($id, $data, swoole_websocket_server $server, $fd)
    {
        $this->server = $server;
        try {
            return $this->$id($data, $fd);
        } catch (Exception $ex) {
            if ($ex instanceof BizException) {
                // 意料之中的异常
                return $this->pushFailMessage($fd, $ex->getErrorCode(), $ex->getMessage());
            }
            return $this->pushFailMessage($fd, ErrorCode::$ENUM_SYSTEM_ERROR);
        }
    }

    protected function pushSuccessMessage($fd, $id, $data = null)
    {
        $message = [
            'success' => true,
            'id' => $id,
        ];
        if (isset($data)) {
            $message['data'] = $data;
        }
        return $this->server->push($fd, json_encode($message));
    }

    protected function pushFailMessage($fd, $errorCode, $errorMessage = null)
    {
        if (!isset($errorMessage)) {
            $errorMessage = ErrorCode::getMessage($errorCode);
        }
        $message = json_encode([
            'success' => false,
            'errorCode' => $errorCode,
            'errorMessage' => $errorMessage
        ]);
        return $this->server->push($fd, $message);
    }

    protected function init($data, $fd)
    {
        $token = Arr::get($data, 'token');
        if (empty($token)) {
            throw new BizException(ErrorCode::$ENUM_TOKEN_INVALIAD);
        }

        return $this->pushSuccessMessage($fd, 'init');
    }
}
