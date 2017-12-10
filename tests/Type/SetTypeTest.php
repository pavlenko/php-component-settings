<?php

namespace PETest\Component\Settings\Type;

use PE\Component\Settings\Exception\InvalidArgumentException;
use PE\Component\Settings\Type\SetType;

class SetTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SetType
     */
    private $type;

    protected function setUp()
    {
        $this->type = new SetType(['foo' => 'Foo', 'bar' => 'Bar']);
    }

    public function testConstructThrowsExceptionIFValuesHasNotStringKeys()
    {
        $this->expectException(InvalidArgumentException::class);
        new SetType(['a']);
    }

    public function testValues()
    {
        static::assertSame(['foo' => 'Foo', 'bar' => 'Bar'], $this->type->getValues());
    }

    public function testDecode()
    {
        static::assertSame([], $this->type->decodeValue('["baz"]'));
        static::assertSame([], $this->type->decodeValue('{]'));
        static::assertSame(['foo'], $this->type->decodeValue('["foo"]'));
    }

    public function testEncode()
    {
        static::assertSame('[]', $this->type->encodeValue('baz'));
        static::assertSame('["foo"]', $this->type->encodeValue('foo'));
        static::assertSame('["foo","bar"]', $this->type->encodeValue(['foo', 'bar']));
    }
}
