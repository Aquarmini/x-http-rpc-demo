<?php
// +----------------------------------------------------------------------
// | Client.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------

namespace Optimon\Api;

use Optimon\Api\Exceptions\ClientInitException;
use Optimon\Api\Exceptions\ResponseException;

abstract class Client implements ClientInterface
{
    public $logHandler;

    public function __construct()
    {
        $handler = $this->getApiHandlerInstance();
        if (!$handler instanceof Handler) {
            throw new ClientInitException('The Api Handler must instanceof ' . Handler::class);
        }
        $this->init();
        $this->initLogHander();
    }

    public function setLogHandler(callable $callback)
    {
        $this->logHandler = $callback;
        return $this;
    }

    public function __call($name, $arguments)
    {
        try {
            $handler = $this->getApiHandlerInstance();
            return $handler->$name(...$arguments);
        } catch (\Exception $ex) {
            if (!($ex instanceof ResponseException) && is_callable($this->logHandler)) {
                $message = '';
                $message .= 'Class：' . get_called_class() . PHP_EOL;
                $message .= 'Options:' . substr(json_encode($arguments, JSON_UNESCAPED_UNICODE), 0, 1000) . PHP_EOL;
                $message .= 'Message:' . $ex->getMessage() . PHP_EOL;
                $func = $this->logHandler;
                $func($message);

                $message = json_encode([
                    'code' => ResponseException::SYSTEM_REQUEST_ERROR_CODE,
                    'message' => $ex->getMessage(),
                ]);

                throw new ResponseException($message, ResponseException::SYSTEM_ERROR_CODE);
            }
            throw $ex;
        }
    }
}
