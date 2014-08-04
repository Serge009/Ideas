<?php


class Application {
    /** @var null The controller */
    private $url_controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $url_action = null;

    /** @var null Parameters */
    private $url_parameter_1 = null;
    private $url_parameter_2 = null;
    private $url_parameter_3 = null;

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        // create array with URL parts in $url
        $this->splitUrl();
        session_start();

        $this->checkAccess();
        // check for controller: does such a controller exist ?
        if ($this->url_controller && class_exists($this->url_controller . "Controller", true)) {
            $this->url_controller .= "Controller";
            // if so, then load this file and create this controller
           $this->url_controller = new $this->url_controller($em);

            // check for method: does such a method exist in the controller ?
            if (method_exists($this->url_controller, $this->url_action)) {
                $this->url_controller->{$this->url_action}();

            } else {
                $this->url_controller->index();
            }
        } else {
            $this->url_controller = new MainController($em);
        }

        return;
    }

    private function splitUrl()
    {
        if (isset($_GET['url'])) {

            // split URL
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // Put URL parts into according properties
            $this->url_controller = (isset($url[0]) ? $url[0] : null);
            $this->url_action = (isset($url[1]) ? $url[1] : null);
            $this->url_parameter_1 = (isset($url[2]) ? $url[2] : null);
            $this->url_parameter_2 = (isset($url[3]) ? $url[3] : null);
            $this->url_parameter_3 = (isset($url[4]) ? $url[4] : null);

            if($this->url_controller){
                $this->url_controller = ucfirst(strtolower($this->url_controller));
            }

         }
    }

    private function checkAccess(){
        $controller = strtolower($this->url_controller);
        if(isset($_SESSION['user_type'])){

            $userType = $_SESSION['user_type'];

            switch($userType){
                case ROLE_ADMIN:
                    if(!in_array($controller, UserTypes::$adminPages))
                        header("Location: " . URL . "admin");
                    break;

                case ROLE_USER:
                    if(!in_array($controller, UserTypes::$userPages))
                        header("Location: " . URL );
                    break;

                default:
                    session_destroy();
                    header("Location: " . URL . "login");
            }

        } elseif($controller != "login"){
            session_destroy();
            header("Location: " . URL . "login");
        }


    }
}