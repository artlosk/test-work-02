<?php

namespace application\controllers\frontend;

use application\core\Controller;

/**
 * Class DefaultController
 * @package application\controllers\frontend
 */
class DefaultController extends Controller
{

    /**
     * Action main frontend page
     */
    public function actionIndex()
    {
        $this->view->render('index');
    }

}