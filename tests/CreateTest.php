<?php

namespace Medz\Component\CreateOrderLength\Test;

use Medz\Component\CreateOrderLength;
use PHPUnit_Framework_TestCase;

class CreateTest extends PHPUnit_Framework_TestCase
{
    public function testClssHas()
    {
        $this->assertTrue(class_exists('Medz\\Component\\CreateOrderLength'));
    }
}
