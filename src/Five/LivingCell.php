<?php

namespace Laraconway\Five;

class LivingCell extends Cell
{
    public function isAlive()
    {
        return true;
    }

    public function isDead()
    {
        return false;
    }

    public function aliveInNextRound($livingNeighbours)
    {
        return $livingNeighbours >= 2 && $livingNeighbours <= 3;
    }
}
