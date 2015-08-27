<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Role extends Model_Auth_Role {

    function get($name){
        return $this->$name;
    }

	// This class can be replaced or extended

} // End Role Model