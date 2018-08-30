<?php

namespace application\controllers\backend;

use application\core\Controller;

/**
 * Class DefaultController
 * @package application\controllers\backend
 */
class DefaultController extends Controller
{

    /**
     * DefaultController constructor.
     * @param $route
     */
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'backend';
    }

    /**
     * Action index page (dashboard)
     */
    public function actionIndex()
    {
        $this->view->render('index');
    }

    /**
     * Action logout from dashboard
     */
    public function actionLogout()
    {
        unset($_SESSION['admin']);
        $this->view->redirect('auth/login');
    }
}