<?php
// +----------------------------------------------------------------------
// | TestClient.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\App;

use Optimon\Api\Client;
use Xin\Traits\Common\InstanceTrait;

class TestClient extends Client
{
    use InstanceTrait;

    public function getApiHandlerInstance()
    {
        return TestHandler::getInstance();
    }

    public function initLogHander()
    {
        $logger = new \Phalcon\Logger\Adapter\File(BASE_PATH . '/info.log');
        $this->getApiHandlerInstance()->setLogHandler(function ($data) use ($logger) {
            $logger->info($data);
        });

        $this->setLogHandler(function ($data) use ($logger) {
            $logger->error($data);
        });
    }
}