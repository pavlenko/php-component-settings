<?php

namespace PETest\Component\Settings\Type;

use PE\Component\Settings\Type\StringType;

class StringTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testDecode()
    {
        static::assertSame('1', (new StringType())->decodeValue('1'));
    }

    public function testEncode()
    {
        static::assertSame('1', (new StringType())->encodeValue(1));
    }
}
