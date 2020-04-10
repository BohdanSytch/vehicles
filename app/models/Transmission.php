<?php

namespace App\models;

use Exception;
use App\traits\ShortClassName as ShortClassName;
use App\traits\TypeSetterGetter as TypeSetterGetter;

class Transmission
{
    use ShortClassName;
    use TypeSetterGetter;

    public const TYPE_MANUAL    = 'manual';
    public const TYPE_AUTOMATIC = 'automatic';

    public static $types = [
        self::TYPE_MANUAL    => 'Manual',
        self::TYPE_AUTOMATIC => 'Automatic',
    ];

    protected $type;
    protected $speeds;

    public function __construct($type, $speeds)
    {
        $this->setType($type);
        $this->setSpeeds($speeds);
    }

    // Speeds
    public function setSpeeds($speeds)
    {
        if (intval($speeds) <= 0) {
            throw new Exception('Incorect ' . $this->getShortClassName() . ' speeds "' . $speeds . '"');
        }

        $this->speeds = (int) $speeds;
    }

    public function getSpeeds()
    {
        return $this->speeds;
    }

    public function __toString()
    {
        return
            "Transmission \n"
            . " Type: " . $this->getTypeTitle() . "\n"
            . " Speeds: " . $this->getSpeeds() . "\n";
    }
}
