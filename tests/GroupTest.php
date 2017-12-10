<?php

namespace PETest\Component\Settings;

use PE\Component\Settings\Group;
use PE\Component\Settings\Setting;

class GroupTest extends \PHPUnit_Framework_TestCase
{
    public function testGroup()
    {
        $setting = $this->createMock(Setting::class);
        $group   = new Group('name', 'label', ['foo' => $setting]);

        static::assertSame('name', $group->getName());
        static::assertSame('label', $group->getLabel());
        static::assertSame(['foo' => $setting], $group->getSettings());
    }
}
