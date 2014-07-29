<?php
/**
 * Created by PhpStorm.
 * User: Matrix
 * Date: 26.06.14
 * Time: 15:39
 */

class Logout extends Controller {

    /**
     * Whenever a controller is created, open a database connection too. The idea behind is to have ONE connection
     */
    public function __construct(){
        parent::__construct();
        return $this->logout();
    }

    private function logout(){
        return false;
    }


} 