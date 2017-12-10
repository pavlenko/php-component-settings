<?php

namespace PETest\Component\Settings\Type;

use PE\Component\Settings\Type\IntegerType;

class IntegerTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testDecode()
    {
        static::assertSame(1, (new IntegerType())->decodeValue('1'));
        static::assertSame(0, (new IntegerType())->decodeValue('0'));
    }

    public function testEncode()
    {
        static::assertSame('1', (new IntegerType())->encodeValue(1));
        static::assertSame('0', (new IntegerType())->encodeValue(0));
    }
}
