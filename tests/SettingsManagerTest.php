<?php

namespace PETest\Component\Settings;

use PE\Component\Settings\Builder\Builder;
use PE\Component\Settings\SettingsManager;
use PE\Component\Settings\Storage\StorageInterface;
use PE\Component\Settings\Type\FloatType;

class SettingsManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StorageInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $storage;

    /**
     * @var Builder|\PHPUnit_Framework_MockObject_MockObject
     */
    private $builder;

    protected function setUp()
    {
        $this->storage = $this->createMock(StorageInterface::class);

        $this->builder = new Builder();
        $this->builder
            ->create('group')
            ->setLabel('Group')
            ->create('setting')
            ->setLabel('Setting')
            ->setType(new FloatType(1));
    }

    public function testConstruct()
    {
        $manager = new SettingsManager($this->storage, $this->builder);

        static::assertCount(1, $groups = $manager->getGroups());
        static::assertCount(1, current($groups)->getSettings());
    }

    public function testGetGroup()
    {
        $this->storage->expects(static::once())->method('getGroup')->willReturn(['setting' => '1.1']);

        $manager = new SettingsManager($this->storage, $this->builder);

        static::assertSame(['setting' => 1.1], $manager->getValues('group'));
        static::assertSame([], $manager->getValues('unknown'));
    }

    public function testSetGroup()
    {
        $this->storage->expects(static::once())->method('setGroup');

        $manager = new SettingsManager($this->storage, $this->builder);

        static::assertSame($manager, $manager->setValues('group', ['setting' => 1.1]));
        static::assertSame($manager, $manager->setValues('unknown', []));
    }

    public function testGetValue()
    {
        $this->storage->expects(static::once())->method('getValue')->willReturn('1.1');

        $manager = new SettingsManager($this->storage, $this->builder);

        static::assertSame(1.1, $manager->getValue('setting'));
    }

    public function testGetValueShouldReturnDefaultIfNull()
    {
        $this->storage->expects(static::once())->method('getValue')->willReturn(null);

        $manager = new SettingsManager($this->storage, $this->builder);

        static::assertSame('default', $manager->getValue('setting', 'default'));
    }

    public function testGetValueShouldReturnDefaultIfUnknown()
    {
        $this->storage->expects(static::never())->method('getValue')->willReturn(null);

        $manager = new SettingsManager($this->storage, $this->builder);

        static::assertSame('default', $manager->getValue('unknown', 'default'));
    }

    public function testSetValue()
    {
        $this->storage->expects(static::once())->method('setValue');

        $manager = new SettingsManager($this->storage, $this->builder);

        static::assertSame($manager, $manager->setValue('setting', 1.1));
        static::assertSame($manager, $manager->setValue('unknown', null));
    }
}
