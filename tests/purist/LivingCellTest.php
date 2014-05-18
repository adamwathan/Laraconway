<?php

namespace Laraconway\V6;

class LivingCellTest extends \PHPUnit_Framework_TestCase
{
    public function test_is_alive()
    {
        $cell = new LivingCell;
        $this->assertTrue($cell->isAlive());
        $this->assertFalse($cell->isDead());
    }

    public function test_live_cell_with_fewer_than_two_live_neighbours_dies()
    {
        $cell = new LivingCell;
        $this->assertFalse($cell->aliveInNextRound($neighbours = 1));
        $this->assertFalse($cell->aliveInNextRound($neighbours = 0));
    }

    public function test_live_cell_with_two_or_three_neighbours_lives()
    {
        $cell = new LivingCell;
        $this->assertTrue($cell->aliveInNextRound($neighbours = 2));
        $this->assertTrue($cell->aliveInNextRound($neighbours = 3));
    }

    public function test_live_cell_with_more_than_three_neighbours_dies()
    {
        $cell = new LivingCell;
        $this->assertFalse($cell->aliveInNextRound($neighbours = 4));
    }
}
