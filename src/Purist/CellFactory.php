<?php

namespace Laraconway\Purist;

class CellFactory
{
    public function alive()
    {
        return new LivingCell;
    }

    public function dead()
    {
        return new DeadCell;
    }
}
