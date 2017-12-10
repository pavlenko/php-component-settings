<?php

namespace PETest\Component\Settings;

use PE\Component\Settings\Setting;
use PE\Component\Settings\Type\TypeInterface;

class SettingTest extends \PHPUnit_Framework_TestCase
{
    public function testSetting()
    {
        /* @var $type TypeInterface|\PHPUnit_Framework_MockObject_MockObject */
        $type    = $this->createMock(TypeInterface::class);
        $setting = new Setting('name', 'label', $type, 'group');

        static::assertSame('name', $setting->getName());
        static::assertSame('label', $setting->getLabel());
        static::assertSame($type, $setting->getType());
        static::assertSame('group', $setting->getGroup());
    }
}
