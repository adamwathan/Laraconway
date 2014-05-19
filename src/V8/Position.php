<?php

namespace Laraconway\V8;

class Position
{
    public $x;
    public $y;

    protected function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public static function create($x, $y)
    {
        return new self($x, $y);
    }

    public function __toString()
    {
        return "{$this->x}, {$this->y}";
    }

    public static function fromString($string)
    {
        $components = explode(",", $string);
        $x = trim($components[0]);
        $y = trim($components[1]);
        return self::create($x, $y);
    }

    public function getNeighbours()
    {
        $positions = [];
        for ($i = -1; $i <= 1; $i++) {
            for ($j = -1; $j <= 1; $j++) {
                if ($i === 0 && $j === 0) {
                    continue;
                }
                $positions[] = self::create($this->x + $i, $this->y + $j);
            }
        }
        return $positions;
    }
}
