<?php

namespace Laraconway\V8;

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
