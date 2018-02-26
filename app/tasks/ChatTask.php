<?php

namespace App\Tasks;

use App\Core\Cli\Task\WebSocket;
use swoole_http_request;
use swoole_websocket_frame;
use swoole_websocket_server;
use Xin\Phalcon\Cli\Traits\Input;

class ChatTask extends WebSocket
{
    use Input;

    public function onConstruct()
    {
        $this->port = 12100;
        $this->host = '127.0.0.1';
    }

    protected function beforeServerStart(swoole_websocket_server $server)
    {
        parent::beforeServerStart($server);
        $config = $this->getConfig();
        if ($this->option('daemonize')) {
            $config['daemonize'] = true;
        }
        // 重置参数
        $server->set($config);
    }

    public function connect(swoole_websocket_server $server, swoole_http_request $request)
    {
        // TODO: Implement connect() method.
    }

    public function message(swoole_websocket_server $server, swoole_websocket_frame $frame)
    {
        $fd = $frame->fd;
        $data = $frame->data;
        dump($fd, $data);
        // echo $fd . ':' . $data . PHP_EOL;
        $server->push($fd, 'ss' . $data);
    }

    public function close(swoole_websocket_server $ser, $fd)
    {
        // TODO: Implement close() method.
    }

    protected function getConfig()
    {
        $pidsDir = di('config')->application->pidsDir;
        return [
            'pid_file' => $pidsDir . 'socket.pid',
            'daemonize' => false,
            'max_request' => 500,
        ];
    }
}

