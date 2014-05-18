<?php

namespace Laraconway\Five;

class DeadCell extends Cell
{
    public function isAlive()
    {
        return false;
    }

    public function isDead()
    {
        return true;
    }

    public function aliveInNextRound($livingNeighbours)
    {
        return $livingNeighbours === 3;
    }
}
