<?php
/**
 * Created by PhpStorm.
 * User: Matrix
 * Date: 04.08.14
 * Time: 15:25
 */

class MainController extends Controller {
    public function index(){
        if(isset($_SESSION['user_type']))
            $this->checkAccess($_SESSION['user_type']);
        else
            $this->checkAccess();
    }

    public function topics(){
        $topics = $this->em->getRepository("Topic")->findAllByUserType(ROLE_USER);
        var_dump($topics);
    }

    public function myTopics(){
        $topics = $this->em->getRepository("Topic")->findAllByUserId($_SESSION['user']->getId());
        var_dump($topics);
    }

    public function shared(){
        $topics = $this->em->getRepository("Topic")->findAllByUserType(ROLE_ADMIN);
        var_dump($topics);
    }
} 