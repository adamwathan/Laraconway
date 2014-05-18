<?php

namespace Laraconway\V6;

class CellFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected $namespace = 'Laraconway\\V6\\';

    public function test_can_create_living_cell()
    {
        $cell_factory = new CellFactory;
        $cell = $cell_factory->alive();
        $this->assertInstanceOf($this->namespace . 'LivingCell', $cell);
    }

    public function test_can_create_dead_cell()
    {
        $cell_factory = new CellFactory;
        $cell = $cell_factory->dead();
        $this->assertInstanceOf($this->namespace . 'DeadCell', $cell);
    }
}
