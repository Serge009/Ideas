<?php
/**
 * Created by PhpStorm.
 * User: Matrix
 * Date: 04.08.14
 * Time: 15:25
 */

class MainController extends Controller {
    public function index(){
        $this->checkAccess();
    }
} 