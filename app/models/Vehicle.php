<?php

namespace App\models;

use Exception;
use App\models\Engine as Engine;
use App\models\Transmission as Transmission;
use App\traits\ShortClassName as ShortClassName;
use App\traits\TypeSetterGetter as TypeSetterGetter;

class Vehicle
{
    use ShortClassName;
    use TypeSetterGetter;

    public const TYPE_CAR   = 'car';
    public const TYPE_TRUCK = 'truck';

    public static $types = [
        self::TYPE_CAR   => 'Car',
        self::TYPE_TRUCK => 'Truck',
    ];

    protected $type;
    protected $engine;
    protected $transmission;
    protected $color;
    protected $interior;
    protected $body;

    protected $additional_options = [];

    public function __construct($type)
    {
        $this->setType($type);
    }

    public function isValid()
    {
        return
            !empty($this->transmission)
            && !empty($this->engine)
            && !empty($this->color);
    }

    // Color
    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }

    // Interior
    public function setInterior($interior)
    {
        $this->interior = $interior;
    }

    public function getInterior()
    {
        return $this->interior;
    }

    // Body
    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }

    // Transmission
    public function setTransmission(Transmission $transmission)
    {
        $this->transmission = $transmission;
    }

    public function getTransmission(): ?Transmission
    {
        return $this->transmission;
    }

    // Engine
    public function setEngine(Engine $engine)
    {
        $this->engine = $engine;
    }

    public function getEngine(): ?Engine
    {
        return $this->engine;
    }

    // Options
    public function addOption($option)
    {
        $this->additional_options[] = $option;
    }

    public function getOptions()
    {
        return $this->additional_options;
    }

    public function clearOptions()
    {
        $this->additional_options = [];
    }

    public function additionalOptionsToString()
    {
        $optionsStr = '';
        foreach ($this->additional_options as $option) {
            $optionsStr .= $option . "\n";
        }
        if (!empty($optionsStr)) {
            $optionsStr = "Additional Options: \n" . $optionsStr;
        }
        return $optionsStr;
    }

    public function __toString()
    {
        return
            "Vehicle \n"
            . " Type: " . $this->getTypeTitle() . "\n"
            . $this->engine
            . $this->transmission
            . " Color: " . $this->getColor() . "\n"
            . " Interior: " . $this->getInterior() . "\n"
            . " Body: " . $this->getBody() . "\n"
            . $this->additionalOptionsToString();
    }
}
