<?php 

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Users extends DataLayer
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        //string "TABLE_NAME", array ["REQUIRED_FIELD_1", "REQUIRED_FIELD_2"], string "PRIMARY_KEY", bool "TIMESTAMPS"
        parent::__construct("users", ["first_name", "last_name"], "id", false);
    }
}