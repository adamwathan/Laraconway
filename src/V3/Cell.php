<?php

namespace Laraconway\V3;

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
}
