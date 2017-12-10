<?php

namespace PETest\Component\Settings\Builder;

use PE\Component\Settings\Builder\Builder;
use PE\Component\Settings\Builder\GroupBuilder;

class BuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Builder
     */
    private $builder;

    protected function setUp()
    {
        $this->builder = new Builder();
    }

    public function testCreate()
    {
        static::assertInstanceOf(GroupBuilder::class, $this->builder->create('foo'));
    }

    public function testBuild()
    {
        static::assertSame([], $this->builder->build());

        $this->builder->create('foo');

        static::assertArrayHasKey('foo', $this->builder->build());
    }
}
