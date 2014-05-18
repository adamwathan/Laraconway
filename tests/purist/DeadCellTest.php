<?php

namespace Laraconway\Purist;

use Mockery as M;

class DeadCellTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        M::close();
    }

    public function test_dead_cell_with_anything_but_three_neighbours_remains_dead()
    {
        $cell = new DeadCell;
        $this->assertTrue($cell->aliveInNextRound(3));
        $this->assertFalse($cell->aliveInNextRound(2));
        $this->assertFalse($cell->aliveInNextRound(4));
    }
}
