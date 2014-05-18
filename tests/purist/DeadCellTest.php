<?php

namespace Laraconway\V6;

class DeadCellTest extends \PHPUnit_Framework_TestCase
{
    public function test_is_dead()
    {
        $cell = new DeadCell;
        $this->assertTrue($cell->isDead());
        $this->assertFalse($cell->isAlive());
    }

    public function test_dead_cell_with_anything_but_three_neighbours_remains_dead()
    {
        $cell = new DeadCell;
        $this->assertTrue($cell->aliveInNextRound($neighbours = 3));
        $this->assertFalse($cell->aliveInNextRound($neighbours = 2));
        $this->assertFalse($cell->aliveInNextRound($neighbours = 4));
    }
}
