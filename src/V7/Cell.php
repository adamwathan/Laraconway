<?php

namespace Laraconway\V7;

abstract class Cell
{
    abstract public function isAlive();
    abstract public function isDead();
    abstract public function aliveInNextRound($livingNeighbours);
}
