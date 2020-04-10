<?php

namespace App\actions;

use App\actions\VehicleAssemblyProcessOperation as AbstractOperation;

class VehicleAssemblyProcessMountEngineOperation extends AbstractOperation
{
    protected $name  = 'vehicle_mount_engine';
    protected $title = 'Vehicle mount engine';

    public function perform(): bool
    {
        echo "perform engine mounting\n";

        return true;
    }
}
