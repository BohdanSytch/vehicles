<?php

namespace App\traits;

use Exception;

trait TypeSetterGetter
{
    use ShortClassName;

    // need static var for types

    public function setType($type)
    {
        if (!$this->isTypeValid($type)) {
            throw new Exception('Incorect ' . $this->getShortClassName() . ' type "' . $type . '"');
        }

        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getTypeTitle($type = null)
    {
        return static::$types[null !== $type ? $type : $this->type];
    }

    public function isTypeValid($type)
    {
        return in_array($type, $this->getAllTypes());
    }

    protected function getAllTypes()
    {
        return array_keys(static::$types);
    }
}
