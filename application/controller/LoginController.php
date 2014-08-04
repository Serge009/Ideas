<?php
/**
 * Login controller
 * @author Serge Naumovych
 */


class LoginController extends Controller {

    public function index(){

        if(!(isset($_POST['login']) || isset($_POST['pass']))){
            //$this->smarty->assign(array('name' => 'Test'));
            //$this->smarty->display("templates/login.php");
            echo $this->twig->render('login.html.twig');
            return;
        }

        $login = $this->validate($_POST["login"]);
        $pass = $this->validate($_POST["pass"]);

        $user = $this->em->getRepository("User")->findBy(array("login" => $login, "pass" => $pass), null, 1);

        if(isset($user[0])){
            $_SESSION['user'] = $user[0];
            $userType = $user[0]->getType()->getId();
            $_SESSION['user_type'] = $userType;
            $this->checkAccess($userType);
        } else {
            //$this->smarty->assign(array('name' => 'Test'));
            //$this->smarty->display("templates/login.php");
            echo $this->twig->render('login.html.twig', array('error' => 'Login or Password is incorrect!'));
        }
    }

}