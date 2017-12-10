<?php

namespace PETest\Component\Settings\Builder;

use PE\Component\Settings\Builder\GroupBuilder;
use PE\Component\Settings\Builder\SettingBuilder;
use PE\Component\Settings\Group;
use PE\Component\Settings\Type\TypeInterface;

class GroupBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GroupBuilder
     */
    private $builder;

    protected function setUp()
    {
        $this->builder = new GroupBuilder('foo');
    }

    public function testConstruct()
    {
        static::assertSame('foo', $this->builder->getName());
    }

    public function testLabel()
    {
        static::assertNull($this->builder->getLabel());
        static::assertSame('label', $this->builder->setLabel('label')->getLabel());
    }

    public function testCreate()
    {
        $settingBuilder1 = $this->builder->create('foo');
        $settingBuilder2 = $this->builder->create('foo');

        static::assertInstanceOf(SettingBuilder::class, $settingBuilder1);
        static::assertSame($settingBuilder1, $settingBuilder2);
    }

    public function testBuild()
    {
        /* @var $type TypeInterface|\PHPUnit_Framework_MockObject_MockObject */
        $type = $this->createMock(TypeInterface::class);

        $this->builder->create('foo')->setType($type);

        $group = $this->builder->build();

        static::assertInstanceOf(Group::class, $group);
        static::assertArrayHasKey('foo', $group->getSettings());
    }
}
