<?php

namespace App\models;

use App\models\Vehicle as Vehicle;

class Truck extends Vehicle
{
    public function __construct()
    {
        parent::__construct(self::TYPE_TRUCK);
    }
}
