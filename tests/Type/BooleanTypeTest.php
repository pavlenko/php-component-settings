<?php

namespace PETest\Component\Settings\Type;

use PE\Component\Settings\Type\BooleanType;

class BooleanTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testDecode()
    {
        static::assertTrue((new BooleanType())->decodeValue('1'));
        static::assertFalse((new BooleanType())->decodeValue('0'));
    }

    public function testEncode()
    {
        static::assertSame('1', (new BooleanType())->encodeValue(true));
        static::assertSame('0', (new BooleanType())->encodeValue(false));
    }
}
