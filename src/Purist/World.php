<?php

namespace Laraconway\Purist;

class World
{
    protected $positions = [];
    protected $numRows;
    protected $numColumns;
    protected $cell_factory;

    public function __construct($cell_factory, $rows = 25, $columns = 25)
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

    public static function create($cell_factory, $rows = 25, $columns = 25)
    {
        return new static($cell_factory, $rows, $columns);
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
        if ($x < 0 || $y < 0 || $x > $this->numRows - 1  || $y > $this->numColumns - 1) {
            return false;
        }
        return $this->getCell($x, $y)->isAlive();
    }

    public function tick()
    {
        $newWorld = [];
        foreach($this->positions as $x => $row) {
            foreach($row as $y => $cell) {
                $newWorld[$x][$y] = $this->nextStateAt($x, $y);
            }
        }
        $this->positions = $newWorld;
    }

    protected function nextStateAt($x, $y)
    {
        $livingNeighbours = $this->countLivingNeighbours($x, $y);
        return $this->getCell($x, $y)->aliveInNextRound($livingNeighbours) ?  $this->cell_factory->alive() :  $this->cell_factory->dead();
    }

    protected function getCell($x, $y)
    {
        return $this->positions[$x][$y];
    }

    protected function countLivingNeighbours($x, $y)
    {
        $livingNeighbours = 0;
        for ($i = -1; $i <= 1; $i++) {
            for ($j = -1; $j <= 1; $j++) {
                if ($i == 0 && $j == 0) {
                    continue;
                }
                $livingNeighbours += $this->livingAt($x+$i, $y+$j) ? 1 : 0;
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
