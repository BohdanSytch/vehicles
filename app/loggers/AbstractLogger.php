<?php

namespace App\loggers;

abstract class AbstractLogger
{
    abstract public function log($msg);
}
