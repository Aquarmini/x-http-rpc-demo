<?php
// +----------------------------------------------------------------------
// | PoiHandler.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Optimon\Api\Handlers;

use Optimon\Api\Environment;
use Optimon\Api\Handler;

class PoiHandler extends Handler
{
    public $baseUris = [
        Environment::DEV => 'http://127.0.0.1:8888',

    ];
}
