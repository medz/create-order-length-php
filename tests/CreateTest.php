<?php

namespace Medz\Component\CreateOrderLength\Test;

use Medz\Component\CreateOrderLength;
use PHPUnit_Framework_TestCase;

class CreateTest extends PHPUnit_Framework_TestCase
{
    /**
     * 测试类是否存在.
     *
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    public function testClssHas()
    {
        $this->assertTrue(class_exists('Medz\\Component\\CreateOrderLength'));
    }

    /**
     * 测试构造的长度抛出异常信息.
     *
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    public function testLengthException()
    {
        $length = 0;
        try {
            $cls = new CreateOrderLength($length);
            $this->assertTrue(false);
        } catch (\Exception $e) {
            $this->assertFalse(false);
        }
    }

    /**
     * 测试生成的数据.
     *
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    public function testCreate()
    {
        $arr = array();
        $length = 1;
        $keys = array('a');
        $fn = function ($str) use (&$arr) {
            array_push($arr, $str);
        };

        $cls = new CreateOrderLength($length, $fn, $keys);
        $cls->start();

        $this->assertEquals($keys, $arr);
        $this->assertCount($length, $arr);
    }
}
