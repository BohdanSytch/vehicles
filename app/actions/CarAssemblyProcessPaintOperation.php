<?php

namespace App\actions;

use App\actions\VehicleAssemblyProcessOperation as AbstractOperation;

class CarAssemblyProcessPaintOperation extends AbstractOperation
{
    protected $name  = 'car_paint';
    protected $title = 'Car paint';

    public function perform(): bool
    {
        echo "perform car painting\n";

        return true;
    }
}
