<?php

namespace App\Models;

class Customer extends User
{
    protected $type = self::TYPE_CUSTOMER;
}
