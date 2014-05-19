<?php

namespace Laraconway\V8;

class CellGrid implements \ArrayAccess, \IteratorAggregate
{
    protected $positions = [];

    public function offsetExists($position)
    {
        return isset($this->positions[(string)$position]);
    }

    public function offsetGet($position)
    {
        return $this->positions[(string)$position];
    }

    public function offsetSet($position, $cell)
    {
        $this->positions[(string)$position] = $cell;
    }

    public function offsetUnset($position)
    {
        unset($this->positions[(string)$position]);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->positions);
    }
}
