<?php

namespace Laraconway\Pragmatic;

abstract class Cell
{
    abstract public function isAlive();
    abstract public function isDead();
    abstract public function aliveInNextRound($livingNeighbours);
}
