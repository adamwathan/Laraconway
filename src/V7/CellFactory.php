<?php

namespace Laraconway\V7;

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
