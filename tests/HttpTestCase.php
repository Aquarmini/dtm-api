<?php
// +----------------------------------------------------------------------
// | 用于请求接口的单元测试基类 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests;

use App\Common\Enums\SystemCode;
use App\Utils\Redis;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpTestCase
 * @package Tests
 * @method ResponseInterface get(string | UriInterface $uri, array $options = [])
 * @method ResponseInterface head(string | UriInterface $uri, array $options = [])
 * @method ResponseInterface put(string | UriInterface $uri, array $options = [])
 * @method ResponseInterface patch(string | UriInterface $uri, array $options = [])
 * @method ResponseInterface delete(string | UriInterface $uri, array $options = [])
 * @method Promise\PromiseInterface getAsync(string | UriInterface $uri, array $options = [])
 * @method Promise\PromiseInterface headAsync(string | UriInterface $uri, array $options = [])
 * @method Promise\PromiseInterface putAsync(string | UriInterface $uri, array $options = [])
 * @method Promise\PromiseInterface postAsync(string | UriInterface $uri, array $options = [])
 * @method Promise\PromiseInterface patchAsync(string | UriInterface $uri, array $options = [])
 * @method Promise\PromiseInterface deleteAsync(string | UriInterface $uri, array $options = [])
 */
abstract class HttpTestCase extends UnitTestCase
{
    public $client;

    public $tokenKey = 'dtm:test:token';

    protected function setUp()
    {
        parent::setUp();
        $this->client = new Client([
            'base_uri' => di('config')->phpunit->url
        ]);

        $token = $this->getUserToken();
        if (empty($token)) {
            $data = [
                'login' => 'limx',
                'password' => md5('910123'),
            ];

            $result = $this->post('/user/login', $data);
            if (!isset($result['data']['token'])) {
                throw new \Exception('Get User Token Failed! ' . json_encode($result));
            }
            $token = $result['data']['token'];
            $this->setUserToken($token);
        }
    }

    protected function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    public function getUserToken()
    {
        $token = Redis::get($this->tokenKey);
        return $token;
    }

    public function setUserToken($token)
    {
        return Redis::set($this->tokenKey, $token);
    }

    public function post($url, $data = [])
    {
        if (di('config')->phpunit->engine === 'php') {
            $url = '?_url=' . $url;
        }
        $res = $this->client->post($url, [
            'json' => $data,
            'headers' => [
                SystemCode::HTTP_X_DTM_TOKEN => $this->getUserToken()
            ],
        ]);
        return json_decode($res->getBody()->getContents(), true);
    }

    public function __call($name, $arguments)
    {
        if (di('config')->phpunit->engine === 'php') {
            $arguments[0] = '?_url=' . $arguments[0];
        }
        $res = $this->client->$name(...$arguments);
        return json_decode($res->getBody()->getContents(), true);
    }
}
