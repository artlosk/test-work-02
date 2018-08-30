<?php

namespace application\controllers\frontend;

use application\core\Controller;
use application\models\Auth;

/**
 * Class AuthController
 * @package application\controllers\frontend
 */
class AuthController extends Controller
{

    /**
     * AuthController constructor.
     * @param $route
     */
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'auth';
    }

    /**
     * action for login to dashboard
     */
    public function actionLogin()
    {
        if (isset($_SESSION['admin'])) {
            $this->view->redirect('backend/default/index');
        }
        if (!empty($_POST) && isset($_POST['login']) && isset($_POST['password'])) {
            $model = new Auth();
            if (!$model->loginValidate($_POST)) {
                $this->view->message('error', $model->error, ['login' => $model->error]);

            }
            $_SESSION['admin'] = true;
            $this->view->redirectJs('backend/default/index');
        }
        $this->view->render('login');
    }
}