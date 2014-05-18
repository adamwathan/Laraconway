<?php

namespace Laraconway\V6;

use Mockery as M;

class WorldTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        M::close();
    }

    public function test_can_place_living_cell()
    {
        $cell_factory = M::mock('Laraconway\\Purist\\CellFactory');
        $living_cell = M::mock('Laraconway\\Purist\\LivingCell');
        $dead_cell = M::mock('Laraconway\\Purist\\DeadCell');

        $cell_factory->shouldReceive('dead')->andReturn($dead_cell);
        $cell_factory->shouldReceive('alive')->andReturn($living_cell)->once();

        $dead_cell->shouldReceive('isAlive')->andReturn(false);
        $living_cell->shouldReceive('isAlive')->andReturn(true)->once();

        $world = World::create(25, 25, $cell_factory);
        $world->setAliveAt(5, 5);
        $this->assertTrue($world->livingAt(5, 5));
        $this->assertFalse($world->livingAt(0, 0));
    }
}
