<?php
/**
 * Created by PhpStorm.
 * User: Matrix
 * Date: 04.08.14
 * Time: 15:47
 */

class AdminController extends Controller {

    public function index(){
        echo "Dashboard";
    }

    public function topics(){
        $topics = $this->em->getRepository("Topic")->findAll();
        var_dump($topics);
    }

    public function comments(){
        $comments = $this->em->getRepository("Comment")->findAll();
        var_dump($comments);
    }

    public function users(){
        $users = $this->em->getRepository("User")->findAll();
        var_dump($users);
    }

} 