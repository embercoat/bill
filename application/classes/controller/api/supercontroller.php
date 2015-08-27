<?php
/**
 *
 * @author draco
 * This is the supercontroller that all the other controllers inherit from.
 * Contains the things that are common for all the controllers
 *
 */
class Controller_Api_SuperController extends Controller_SuperController
{
    var $data = null;
    function before(){}
    function after(){
        // Default to JSON
        if(!is_null($this->data)) {
            $this->response->body(json_encode($this->data));
        }

    }
}
