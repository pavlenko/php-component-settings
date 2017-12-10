<?php

namespace PETest\Component\Settings\Type;

use PE\Component\Settings\Type\FloatType;

class FloatTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testDecode()
    {
        static::assertSame(1.1, (new FloatType(1))->decodeValue('1.1'));
        static::assertSame(0.1, (new FloatType(1))->decodeValue('0.09'));
    }

    public function testEncode()
    {
        static::assertSame('1.3', (new FloatType(1))->encodeValue(1.25));
    }
}
