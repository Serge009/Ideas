<?php
/**
 * Login controller
 * @author Serge Naumovych
 */


class login extends Controller {

    public function index(){
        if(!(isset($_POST['login']) || isset($_POST['pass']))){
            include_once "templates/login.php";
            return;
        }

        $login = $this->validate($_POST["login"]);
        $pass = $this->validate($_POST["pass"]);

        try{
            $model = new LoginModel();
            $res = $model->login($login, $pass);
            if($res)
                echo "OK";
            else
                echo "Err";
        } catch(ModelException $e){
            //NOP
        }

       include_once "templates/login.php";
    }
}