<?php

namespace application\controllers\backend;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Client;

/**
 * Class ClientController
 * @package application\controllers\backend
 */
class ClientController extends Controller
{

    /**
     * ClientController constructor.
     * @param $route
     */
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'backend';
    }

    /**
     * Action create user
     */
    public function actionCreate()
    {
        $model = new Client();
        if (!empty($_POST)) {
            $model->setAttributes($_POST);
            if ($model->save()) {
                $this->view->redirectJs('backend/client/update/' . $model->id);
                //debug($model);
            } else {
                $this->view->message('error', implode('<br />', $model->error), $model->error);
            }
        }
        $this->view->render('create');
    }

    /**
     * @param $id
     * Action edit user
     */
    public function actionUpdate($id)
    {
        $model = new Client();
        $model->findOne($id);

        if (!empty($_POST)) {
            $model->setAttributes($_POST);

            if ($model->save()) {
                $this->view->redirectJs('backend/client/update/' . $model->id);
            } else {
                $this->view->message('error', implode('<br />', $model->error), $model->error);
            }
        }

        $this->view->render('update', [
            'data' => $model
        ]);
    }

    /**
     * @param $id
     * Action delete user
     */
    public function actionDelete($id)
    {
        $model = new Client();
        $model->findOne($id);
        $model->delete();

        $this->view->redirect('backend/client/index');
    }

    /**
     * @param int $page
     * @param string $sort
     * @param string $order
     * Action for list users
     */
    public function actionIndex($page = 1, $sort = 'login', $order = "asc")
    {
        $model = new Client();
        $pagination = new Pagination($this->route, $model->getUserCount(), $model::USER_PER_PAGE);
        $list = $model->getUserList($page, $model::USER_PER_PAGE, $sort, $order);

        $order = $order == 'asc' ? 'desc' : 'asc';

        $this->view->render('index', [
            'pagination' => $pagination->get(),
            'list' => $list,
            'page' => $page,
            'sort' => $sort,
            'order' => $order,
        ]);
    }

    /**
     * @param $id
     * Action for view row
     */
    public function actionView($id)
    {
        $model = new Client();
        $model->findOne($id);

        $this->view->render('view', [
            'data' => $model
        ]);
    }
}