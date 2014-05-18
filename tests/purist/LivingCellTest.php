<?php

namespace Laraconway\V6;

class LivingCellTest extends \PHPUnit_Framework_TestCase
{
    public function test_live_cell_with_fewer_than_two_live_neighbours_dies()
    {
        $cell = new LivingCell;
        $this->assertFalse($cell->aliveInNextRound(1));
    }

    public function test_live_cell_with_no_live_neighbours_dies()
    {
        $cell = new LivingCell;
        $this->assertFalse($cell->aliveInNextRound(0));
    }

    public function test_live_cell_with_two_neighbours_lives()
    {
        $cell = new LivingCell;
        $this->assertTrue($cell->aliveInNextRound(2));
    }

    public function test_live_cell_with_three_neighbours_lives()
    {
        $cell = new LivingCell;
        $this->assertTrue($cell->aliveInNextRound(3));
    }
}
