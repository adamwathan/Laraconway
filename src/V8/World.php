<?php

namespace Laraconway\V8;

class World
{
    protected $positions;
    protected $numRows;
    protected $numColumns;
    protected $cell_factory;

    protected function __construct($rows, $columns, $cell_factory)
    {
        $this->numRows = $rows;
        $this->numColumns = $columns;
        $this->cell_factory = $cell_factory;
        $this->positions = new CellGrid;

        for ($x = 0; $x < $rows; $x++) {
            for ($y = 0; $y < $columns; $y++) {
                $this->setDeadAt(Position::create($x, $y));
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

    public function setAliveAt($x, $y = null)
    {
        $position = $this->getPosition($x, $y);
        $this->positions[$position] = $this->cell_factory->alive();
    }

    protected function getPosition($x, $y)
    {
        if ($x instanceof Position) {
            return $x;
        }
        return Position::create($x, $y);
    }

    public function setDeadAt($x, $y = null)
    {
        $position = $this->getPosition($x, $y);
        $this->positions[$position] =  $this->cell_factory->dead();
    }

    public function livingAt($x, $y = null)
    {
        $position = $this->getPosition($x, $y);
        return $this->getCell($position)->isAlive();
    }

    public function tick()
    {
        $new_world = new CellGrid;
        foreach ($this->positions as $position => $cell) {
            $position = Position::fromString($position);
            if ($this->aliveInNextRound($position)) {
                $new_world[$position] = $this->cell_factory->alive();
            } else {
                $new_world[$position] = $this->cell_factory->dead();
            }
        }
        $this->positions = $new_world;
    }

    protected function aliveInNextRound($position)
    {
        $livingNeighbours = $this->countLivingNeighbours($position);
        return $this->getCell($position)->aliveInNextRound($livingNeighbours);
    }

    protected function getCell($position)
    {
        if ($this->outOfBounds($position)) {
            return $this->cell_factory->dead();
        }
        return $this->positions[$position];
    }

    protected function outOfBounds($position)
    {
        $x = $position->x;
        $y = $position->y;
        return ($x < 0 || $y < 0 || $x > $this->numRows - 1  || $y > $this->numColumns - 1);
    }

    protected function countLivingNeighbours($position)
    {
        $neighbour_cells = $position->getNeighbours();
        $livingNeighbours = 0;
        foreach ($neighbour_cells as $neighbour) {
            $livingNeighbours += $this->livingAt($neighbour) ? 1 : 0;
        }
        return $livingNeighbours;
    }
}
