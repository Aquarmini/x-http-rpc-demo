<?php
// +----------------------------------------------------------------------
// | TestClient.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\App;

use Optimon\Api\Environment;
use Optimon\Api\Handler;
use Xin\Traits\Common\InstanceTrait;

class TestHandler extends Handler
{
    use InstanceTrait;

    protected $timeout = 5;

    public $baseUris = [
        Environment::DEV => 'http://api.demo.phalcon.lmx0536.cn',
        Environment::QA => 'http://api.demo.phalcon.lmx0536.cn',
        Environment::PRE => 'http://api.demo.phalcon.lmx0536.cn',
        Environment::GR => 'http://api.demo.phalcon.lmx0536.cn',
        Environment::PRD => 'http://api.demo.phalcon.lmx0536.cn',
    ];

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
