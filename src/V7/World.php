<?php

namespace Laraconway\V7;

class World
{
    protected $positions = [];
    protected $numRows;
    protected $numColumns;
    protected $cell_factory;

    protected function __construct($rows, $columns, $cell_factory)
    {
        $this->numRows = $rows;
        $this->numColumns = $columns;
        $this->cell_factory = $cell_factory;

        for ($x = 0; $x < $rows; $x++) {
            for ($y = 0; $y < $columns; $y++) {
                $this->setDeadAt($x, $y);
            }
        }
    }

    public static function create($rows = 25, $columns = 25, $cell_factory = null)
    {
        if (is_null($cell_factory)) {
            $cell_factory = new CellFactory;
        }
        return new static($rows, $columns, $cell_factory);
    }

    public function setAliveAt($x, $y)
    {
        $this->positions[$x][$y] = $this->cell_factory->alive();
    }

    public function setDeadAt($x, $y)
    {
        $this->positions[$x][$y] =  $this->cell_factory->dead();
    }

    public function livingAt($x, $y)
    {
        return $this->getCell($x, $y)->isAlive();
    }

    public function tick()
    {
        $new_world = [];
        foreach ($this->positions as $x => $row) {
            foreach ($row as $y => $cell) {
                if ($this->aliveInNextRound($x, $y)) {
                    $new_world[$x][$y] = $this->cell_factory->alive();
                } else {
                    $new_world[$x][$y] = $this->cell_factory->dead();
                }
            }
        }
        $this->positions = $new_world;
    }

    protected function aliveInNextRound($x, $y)
    {
        $livingNeighbours = $this->countLivingNeighbours($x, $y);
        return $this->getCell($x, $y)->aliveInNextRound($livingNeighbours);
    }

    protected function getCell($x, $y)
    {
        if ($this->outOfBounds($x, $y)) {
            return $this->cell_factory->dead();
        }
        return $this->positions[$x][$y];
    }

    protected function outOfBounds($x, $y)
    {
        return ($x < 0 || $y < 0 || $x > $this->numRows - 1  || $y > $this->numColumns - 1);
    }

    protected function countLivingNeighbours($x, $y)
    {
        $livingNeighbours = 0;
        for ($i = -1; $i <= 1; $i++) {
            for ($j = -1; $j <= 1; $j++) {
                if ($i == 0 && $j == 0) {
                    continue;
                }
                $livingNeighbours += $this->livingAt($x + $i, $y + $j) ? 1 : 0;
            }
        }
        return $livingNeighbours;
    }

    public function draw()
    {
        $serialized = [];
        foreach ($this->positions as $row) {
            $rowRep = [];
            foreach ($row as $cell) {
               $rowRep[] = $cell ? "X" : " ";
           }
           $serialized[] = $rowRep;
       }
       return $serialized;
   }
}
