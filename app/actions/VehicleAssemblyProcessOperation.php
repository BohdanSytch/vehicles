<?php

namespace App\actions;

abstract class VehicleAssemblyProcessOperation
{
    protected $name;
    protected $title;

    abstract public function perform(): bool;

    public function __toString()
    {
        return
            "Assembly process operation "
            . $this->name
            . ' ' . $this->title;
    }
}
