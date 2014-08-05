<?php
/**
 * Created by PhpStorm.
 * User: Matrix
 * Date: 04.08.14
 * Time: 15:53
 */

class TopicsController extends Controller {

    protected function setOptions(){
        $this->smarty = new Smarty();
        $this->loader = new Twig_Loader_Filesystem("public/templates/admin");
        $this->twig = new Twig_Environment($this->loader);
    }

    public function index(){

        $topics = $this->em->getRepository("Topic")->findAllByUserType(ROLE_USER);

        echo $this->twig->render("topics.html.twig", array("topics" => $topics));
    }

    public function delete($id){
        $this->changeStatus($id, true);
        header("Location: " . URL . "admin/topics");
    }

    public function activate($id){
        $this->changeStatus($id, false);

        header("Location: " . URL . "admin/topics");
    }

    /**
     * @param integer $id
     * @param boolean $status
     */
    private function changeStatus($id, $status){
        try{
            $topic = $this->em->getRepository("Topic")->findOneBy(array("id" => $id));
            if($topic){
                $topic->setDeleted($status);
                $this->em->persist($topic);
                $this->em->flush();
            }
        } catch(Exception $e){
            //NOP
        }
    }

} 