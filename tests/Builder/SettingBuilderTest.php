<?php

namespace PETest\Component\Settings\Builder;

use PE\Component\Settings\Builder\SettingBuilder;
use PE\Component\Settings\Exception\RuntimeException;
use PE\Component\Settings\Setting;
use PE\Component\Settings\Type\TypeInterface;

class SettingBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SettingBuilder
     */
    private $builder;

    protected function setUp()
    {
        $this->builder = new SettingBuilder('foo', 'bar');
    }

    public function testConstruct()
    {
        static::assertSame('foo', $this->builder->getName());
        static::assertSame('bar', $this->builder->getGroup());
    }

    public function testLabel()
    {
        static::assertNull($this->builder->getLabel());
        static::assertSame('label', $this->builder->setLabel('label')->getLabel());
    }

    public function testType()
    {
        /* @var $type TypeInterface|\PHPUnit_Framework_MockObject_MockObject */
        $type = $this->createMock(TypeInterface::class);

        static::assertNull($this->builder->getType());
        static::assertSame($type, $this->builder->setType($type)->getType());
    }

    public function testBuildThrowsExceptionIfTypeNotSet()
    {
        $this->expectException(RuntimeException::class);
        $this->builder->build();
    }

    public function testBuild()
    {
        /* @var $type TypeInterface|\PHPUnit_Framework_MockObject_MockObject */
        $type = $this->createMock(TypeInterface::class);
        $this->builder->setType($type);

        $setting = $this->builder->build();

        static::assertInstanceOf(Setting::class, $setting);
        static::assertSame($type, $setting->getType());
    }
}
