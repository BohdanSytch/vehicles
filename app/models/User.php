<?php

namespace App\Models;

use Exception;
use App\traits\ShortClassName as ShortClassName;

class User
{
    use ShortClassName;

    public const TYPE_USER     = 'user';
    public const TYPE_CUSTOMER = 'customer';
    public const TYPE_MANAGER  = 'manager';

    public static $types = [
        self::TYPE_USER     => 'User',
        self::TYPE_CUSTOMER => 'Customer',
        self::TYPE_MANAGER  => 'Manager',
    ];

    protected $email;
    protected $type = self::TYPE_USER;

    public function __construct($email)
    {
        $this->setEmail($email);
    }

    public function setEmail($email)
    {
        if (!$this->isValidEmail($email)) {
            throw new Exception('Incorect ' . $this->getShortClassName() . ' email "' . $email . '"');
        }

        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function isValidEmail($email)
    {
        return false !== filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function getType()
    {
        return $this->type;
    }

    public function getTypeTitle($type = null)
    {
        return static::$types[null !== $type ? $type : $this->type];
    }

    public function __toString()
    {
        return
            $this->getTypeTitle()
            . " Email: " . $this->getEmail() . "\n";
    }
}
