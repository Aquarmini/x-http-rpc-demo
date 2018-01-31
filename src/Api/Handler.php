<?php
// +----------------------------------------------------------------------
// | Client.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------

namespace Optimon\Api;

use limx\Support\Arr;
use Optimon\Api\Exceptions\ResponseException;
use Psr\Http\Message\ResponseInterface;
use Xin\Http\Rpc\Client as RpcClient;
use Xin\Http\Rpc\Exceptions\InitException;

abstract class Handler extends RpcClient
{
    public $logHandler;

    public $environment;

    const RESPONSE_KEY_DATA = 'model';

    const RESPONSE_KEY_ERROR_CODE = 'errorCode';

    const RESPONSE_KEY_ERROR_MESSAGE = 'errorMessage';

    protected function getBaseUri()
    {
        if (!isset($this->environment)) {
            throw new InitException('请使用setEnvironment方法设置$environment变量');
        }

        if (!isset($this->baseUris)) {
            throw new InitException('请设置baseUris参数');
        }

        switch ($this->environment) {
            case Environment::LOCAL:
            case Environment::TEST:
                $this->environment = Environment::DEV;
                break;
            case Environment::PRODUCTION:
                $this->environment = Environment::PRD;
                break;
        }

        if (!isset($this->baseUris[$this->environment])) {
            throw new InitException('PHP API 环境参数设置有误');
        }

        return $this->baseUris[$this->environment];
    }

    public function setEnvironment($env)
    {
        $this->environment = $env;
    }

    public function setLogHandler(callable $callback)
    {
        $this->logHandler = $callback;
        return $this;
    }

    protected function afterExecute($method, $arguments, ResponseInterface $response)
    {
        if (is_callable($this->logHandler)) {
            $message = '';
            $message .= 'Class：' . get_called_class() . PHP_EOL;
            $message .= 'Options:' . substr(json_encode($arguments, JSON_UNESCAPED_UNICODE), 0, 1000) . PHP_EOL;
            $message .= 'Response:' . substr($response->getBody(), 0, 1000) . PHP_EOL;

            $func = $this->logHandler;
            $func($message);
        }
    }

    protected function handleResponse($method, $arguments, string $response)
    {
        $result = json_decode($response, true);
        if ($result['success'] !== true) {
            $errorCode = Arr::get($result, static::RESPONSE_KEY_ERROR_CODE, '');
            $errorMessage = Arr::get($result, static::RESPONSE_KEY_ERROR_MESSAGE, '');

            throw new ResponseException($errorMessage, $errorCode);
        }

        return $result[static::RESPONSE_KEY_DATA];
    }
}
