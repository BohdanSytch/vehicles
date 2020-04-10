<?php

namespace App\models;

use App\models\Vehicle as Vehicle;

class Car extends Vehicle
{
    public function __construct()
    {
        parent::__construct(self::TYPE_CAR);
    }
}
