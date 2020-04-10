<?php

namespace App\models;

use Exception;
use App\traits\ShortClassName as ShortClassName;
use App\traits\TypeSetterGetter as TypeSetterGetter;

class Engine
{
    use ShortClassName;
    use TypeSetterGetter;

    public const TYPE_2STROKE = 2;
    public const TYPE_4STROKE = 4;
    public const TYPE_6STROKE = 6;

    public static $types = [
        self::TYPE_2STROKE   => '2 Stroke',
        self::TYPE_4STROKE   => '4 Stroke',
        self::TYPE_6STROKE   => '6 Stroke',
    ];

    protected $type;
    protected $displacement;

    public function __construct($type, $displacement)
    {
        $this->setType($type);
        $this->setDisplacement($displacement);
    }

    public function setDisplacement($displacement)
    {
        if (floatval($displacement) <= 0) {
            throw new Exception('Incorect ' . $this->getShortClassName() . ' displacement "' . $displacement . '"');
        }

        $this->displacement = (float) $displacement;
    }

    public function getDisplacement()
    {
        return $this->displacement;
    }

    public function __toString()
    {
        return
            "Engine \n"
            . " Type: " . $this->getTypeTitle() . "\n"
            . " Displacement: " . $this->getDisplacement() . "\n";
    }
}
