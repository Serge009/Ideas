<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */

use \Doctrine\ORM\EntityManager;

class Controller
{
    /**
     * @var EntityManager
     */
    protected $em;

    protected $loader;
    protected $twig;
    protected $smarty;

    function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->smarty = new Smarty();
        $this->loader = new Twig_Loader_Filesystem("templates/");
        $this->twig = new Twig_Environment($this->loader);
    }

    public function index(){
        $this->checkAccess();
    }


    public function validate($data){
        return trim(strip_tags($data));
    }

    protected function checkAccess($userType = 0){
        switch($userType){
            case ROLE_ADMIN:
                header("Location: " . URL . "admin");
                break;
            case ROLE_USER:
                header("Location: " . URL);
                break;
            default:
                header("Location: " . URL . "login");
                break;
        }
    }
}
