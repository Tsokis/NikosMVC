<?php
/**
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT -/controller/method/params
 */

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {

        //print_r($this->getUrl());
        $url = $this->getUrl();
        //look in controllers for first value
        if(file_exists('../app/controllers/' . ucwords($url[0] .'.php'))) {
            //if exists, set as controller
            $this->currentController = ucwords($url[0]);
            //Unset 0 index
            unset($url[0]);
        }

        //require the controller
        require_once '../app/controllers/'. $this->currentController .'.php';

        //instatiate controller class
        $this->currentController = new $this->currentController;
        //check for the second part of the url
        if(isset($url[1])) {
            //check if method exists in controller
            if(method_exists($this->currentController,$url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        //Get parameters
        $this->params = $url ? array_values($url) : [];
        //call a callback with array of parameters
        call_user_func_array([$this->currentController, $this->currentMethod],$this->params);
    }

    public function getUrl() {
        /*getting the value   nikosmvc/?url=test */
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/',$url);
            return $url;
        }
        //echo $_GET['url'];
    }
}