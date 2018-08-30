<?php

/* @var $data application\models\Client */

$this->title = 'Просмотр пользователя';
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?= $this->title ?></div>
            <div class="card-body">
                <p>
                    <a href="/backend/client/update/<?= $data->id ?>" class="btn btn-primary">
                        <i class="fa fa-pencil"></i>
                        Редактировать
                    </a>
                    <a href="backend/client/delete/<?= $data->id ?>" data-toggle="modal" data-target="#confirmDelete"
                       class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                        Удалить
                    </a>
                </p>
                <div class="row">
                    <div class="col-sm-4">
                        <table class="table">
                            <tr>
                                <th>Логин</th>
                                <td><?= $data->login ?></td>
                            </tr>
                            <tr>
                                <th>Имя</th>
                                <td><?= $data->firstname ?></td>
                            </tr>
                            <tr>
                                <th>Фамилия</th>
                                <td><?= $data->lastname ?></td>
                            </tr>
                            <tr>
                                <th>Пол</th>
                                <td><?= $data->getGender() ?></td>
                            </tr>
                            <tr>
                                <th>Дата рождения</th>
                                <td><?= $data->dob ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Dialog -->
<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Удалить</h4>
            </div>
            <div class="modal-body">
                <p>Вы действительно хотите удалить?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <a href="/backend/client/delete/<?= $data->id ?>" class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                    Удалить
                </a>
            </div>
        </div>
    </div>
</div>