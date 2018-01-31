<?php
// +----------------------------------------------------------------------
// | ClientInterface.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Optimon\Api;

interface ClientInterface
{
    /**
     * @desc   获取ApiHandler单例
     * @author limx
     * @return mixed
     */
    public function getApiHandlerInstance();

    /**
     *
     *  $logger = new \Phalcon\Logger\Adapter\File(BASE_PATH . '/info.log');
     *  $this->getApiHandlerInstance()->setLogHandler(function ($data) use ($logger) {
     *      $logger->info($data);
     *  });
     *
     *  $this->setLogHandler(function ($data) use ($logger) {
     *      $logger->error($data);
     *  });
     */
    public function initLogHander();

    /**
     * @desc   初始化
     * @author limx
     * @return mixed
     */
    public function init();
}
