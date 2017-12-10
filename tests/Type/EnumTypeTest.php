<?php

namespace PETest\Component\Settings\Type;

use PE\Component\Settings\Exception\InvalidArgumentException;
use PE\Component\Settings\Type\EnumType;

class EnumTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EnumType
     */
    private $type;

    protected function setUp()
    {
        $this->type = new EnumType(['foo' => 'Foo', 'bar' => 'Bar']);
    }

    public function testConstructThrowsExceptionIFValuesHasNotStringKeys()
    {
        $this->expectException(InvalidArgumentException::class);
        new EnumType(['a']);
    }

    public function testValues()
    {
        static::assertSame(['foo' => 'Foo', 'bar' => 'Bar'], $this->type->getValues());
    }

    public function testDecode()
    {
        static::assertNull($this->type->decodeValue('baz'));
        static::assertSame('foo', $this->type->decodeValue('foo'));
    }

    public function testEncode()
    {
        static::assertSame('', $this->type->encodeValue('baz'));
        static::assertSame('foo', $this->type->encodeValue('foo'));
    }
}
