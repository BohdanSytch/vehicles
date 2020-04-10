<?php

namespace App\traits;

use ReflectionClass;

trait ShortClassName
{
    public function getShortClassName()
    {
        return strtolower((new ReflectionClass($this))->getShortName());
    }
}
