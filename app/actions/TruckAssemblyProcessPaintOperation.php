<?php

namespace App\actions;

use App\actions\VehicleAssemblyProcessOperation as AbstractOperation;

class TruckAssemblyProcessPaintOperation extends AbstractOperation
{
    protected $name  = 'truck_paint';
    protected $title = 'Truck paint';

    public function perform(): bool
    {
        echo "perform truck painting\n";

        return true;
    }
}
