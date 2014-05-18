<?php

namespace Laraconway;

abstract class Cell
{
    public static function alive()
    {
        return new LivingCell;
    }

    public static function dead()
    {
        return new DeadCell;
    }

    abstract public function isAlive();
    abstract public function isDead();
    abstract public function aliveInNextRound($livingNeighbours);
}
