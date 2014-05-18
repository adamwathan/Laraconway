<?php

namespace Laraconway\Pragmatic;

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
