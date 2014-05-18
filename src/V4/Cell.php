<?php

namespace Laraconway\V4;

class Cell
{
    protected $state = false;

    public function __construct($state)
    {
        $this->state = $state;
    }

    public static function alive()
    {
        return new self(true);
    }

    public static function dead()
    {
        return new self(false);
    }

    public function isAlive()
    {
        return $this->state;
    }

    public function isDead()
    {
        return ! $this->isAlive();
    }

    public function aliveInNextRound($livingNeighbours)
    {
        if ($this->isAlive() && $livingNeighbours < 2) {
            return false;
        }
        if ($this->isAlive() && $livingNeighbours > 3) {
            return false;
        }
        if ($this->isDead() && $livingNeighbours != 3) {
            return false;
        }
        return true;
    }
}
