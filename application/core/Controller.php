<?php

namespace application\core;

/**
 * Class Controller
 * @package application\core
 */
abstract class Controller
{
    /**
     * @var array
     */
    public $route;

    /**
     * @var View
     */
    public $view;

    /**
     * Controller constructor.
     * @param $route
     */
    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        if ($this->route['section'] == 'backend' && !$this->checkAuth()) {
            $this->view->redirect('auth/login');
        }
    }

    /**
     * @param $name
     * @return mixed
     * Method load model by name and check exist this file
     */
    public function loadModel($name)
    {
        $path = 'application\models\\' . ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }

    /**
     * @return bool
     * Method check auth in backend pages
     */
    public function checkAuth()
    {
        if ($this->route['section'] == 'backend' && isset($_SESSION['admin'])) {
            return true;
        }
        return false;
    }

}