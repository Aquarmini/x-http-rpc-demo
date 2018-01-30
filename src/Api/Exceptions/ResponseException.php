<?php
// +----------------------------------------------------------------------
// | ResponseException.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Optimon\Api\Exceptions;

use Exception;
use Throwable;

class ResponseException extends Exception
{
    const SYSTEM_ERROR_CODE = 400;

    const SYSTEM_REQUEST_ERROR_CODE = 401;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = json_encode([
            'code' => $code,
            'message' => $message
        ]);

        parent::__construct($message, static::SYSTEM_ERROR_CODE, $previous);
    }
}
