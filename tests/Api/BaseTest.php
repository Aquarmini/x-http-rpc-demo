<?php
// +----------------------------------------------------------------------
// | BaseTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Api;

use Tests\App\TestClient;
use Tests\TestCase;

class BaseTest extends TestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testPost()
    {
        $result = TestClient::getInstance()->testPost();
        $this->assertEquals('POST', $result['method']);
        $this->assertEquals('limx', $result['body']['name']);
        $this->assertEquals(29, $result['body']['age']);
    }
}
