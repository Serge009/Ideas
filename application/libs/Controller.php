<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
namespace Main{
class Controller
{

    public function validate($data){
        return trim(strip_tags($data));
    }
}
}
