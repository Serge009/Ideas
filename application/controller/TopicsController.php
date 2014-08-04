<?php
/**
 * Created by PhpStorm.
 * User: Matrix
 * Date: 04.08.14
 * Time: 15:53
 */

class TopicsController extends Controller {

    public function index(){
        $topics = $this->em->getRepository("Topic")->findAll();
        var_dump($topics);
    }

    public function create(){
        echo "Create topics page";
    }

} 