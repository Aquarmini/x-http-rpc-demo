<?php
// +----------------------------------------------------------------------
// | TestClient.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\App;

use Optimon\Api\Handler;
use Xin\Traits\Common\InstanceTrait;

class TestHandler extends Handler
{
    use InstanceTrait;

    protected $baseUri = 'http://api.demo.phalcon.lmx0536.cn';

    protected $timeout = 5;

    public function test()
    {
        return $this->get('/?name=limx');
    }

    public function testGet()
    {
        return $this->get('/api/request?name=limx');
    }

    public function testPost()
    {
        $params = [
            'name' => 'limx',
            'age' => 29
        ];
        return $this->post('/api/request', [
            'form_params' => $params
        ]);
    }

    public function testJson()
    {
        $params = [
            'name' => 'Agnes',
            'age' => 28
        ];
        return $this->post('/api/request', [
            'json' => $params
        ]);
    }

    public function test404()
    {
        $params = [
            'name' => 'Agnes',
            'age' => 28
        ];
        return $this->post('/api/404', [
            'json' => $params
        ]);
    }
}
