<?php

namespace Laraconway\V6;

abstract class Cell
{
    abstract public function isAlive();
    abstract public function isDead();
    abstract public function aliveInNextRound($livingNeighbours);
}
