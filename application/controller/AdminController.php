<?php
/**
 * Created by PhpStorm.
 * User: Matrix
 * Date: 04.08.14
 * Time: 15:47
 */

class AdminController extends Controller {

    protected function setOptions(){
        $this->smarty = new Smarty();
        $this->loader = new Twig_Loader_Filesystem("public/templates/admin");
        $this->twig = new Twig_Environment($this->loader);
    }

    public function index(){
        echo $this->twig->render("index.html.twig");
    }

    public function topics(){
        $topics = $this->em->getRepository("Topic")->findAll();
        echo $this->twig->render("topics.html.twig", array("topics" => $topics));
    }

    public function comments(){
        $comments = $this->em->getRepository("Comment")->findAll();
        echo $this->twig->render("comments.html.twig", array("comments" => $comments));
    }

    public function users(){
        $users = $this->em->getRepository("User")->findAll();
        echo $this->twig->render("users.html.twig", array("users" => $users));
    }

} 