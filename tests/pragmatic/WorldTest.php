<?php

namespace Laraconway\V6;

class WorldTest extends \PHPUnit_Framework_TestCase
{
    public function test_can_place_living_cell()
    {
        $world = World::create();
        $world->setAliveAt(5, 5);
        $this->assertTrue($world->livingAt(5, 5));
        $this->assertFalse($world->livingAt(0, 0));
    }

    public function test_live_cell_with_fewer_than_two_live_neighbours_dies()
    {
        $world = World::create();
        $world->setAliveAt(1, 1);
        $world->setAliveAt(0, 1);
        $world->tick();
        $this->assertFalse($world->livingAt(1, 1));
        $this->assertFalse($world->livingAt(0, 1));
    }

    public function test_live_cell_with_two_or_three_live_neighbours_lives()
    {
        $world = World::create();
        $world->setAliveAt(1, 1);
        $world->setAliveAt(0, 1);
        $world->setAliveAt(1, 0);
        $world->tick();
        $this->assertTrue($world->livingAt(1, 1));
    }

    public function test_live_cell_with_more_than_three_live_neighbours_dies()
    {
        $world = World::create();
        $world->setAliveAt(1, 1);
        $world->setAliveAt(0, 1);
        $world->setAliveAt(1, 0);
        $world->setAliveAt(0, 0);
        $world->setAliveAt(2, 2);
        $world->tick();
        $this->assertFalse($world->livingAt(1, 1));
    }

    public function test_dead_cell_with_exactly_three_live_neighbours_becomes_alive()
    {
        $world = World::create();
        $world->setAliveAt(0, 1);
        $world->setAliveAt(1, 0);
        $world->setAliveAt(0, 0);
        $world->tick();
        $this->assertTrue($world->livingAt(1, 1));
    }

    public function test_dead_cell_with_less_than_three_live_neighbours_stays_dead()
    {
        $world = World::create();
        $world->setAliveAt(1, 0);
        $world->setAliveAt(0, 0);
        $world->tick();
        $this->assertFalse($world->livingAt(1, 1));
    }

    public function test_dead_cell_with_greater_than_three_live_neighbours_stays_dead()
    {
        $world = World::create();
        $world->setAliveAt(1, 0);
        $world->setAliveAt(0, 0);
        $world->setAliveAt(1, 2);
        $world->setAliveAt(2, 2);
        $world->tick();
        $this->assertFalse($world->livingAt(1, 1));
    }
}
