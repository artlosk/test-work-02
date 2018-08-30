<?php

use application\models\Client;

$this->title = 'Добавление пользователя';
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?= $this->title ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <form action="create" method="post">
                            <div class="form-group">
                                <label for="login">Логин</label>
                                <input type="text" class="form-control" name="login" id="login">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input type="password" class="form-control" name="password" id="password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="firstname">Имя</label>
                                <input type="text" class="form-control" name="firstname" id="firstname">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Фамилия</label>
                                <input type="text" class="form-control" name="lastname" id="lastname">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="gender">Пол</label>
                                <select name="gender" class="form-control" id="gender">
                                    <?php foreach (Client::getGenderList() as $key => $val) : ?>
                                        <option value="<?= $key ?>"><?= $val ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="dob">Дата рождения</label>
                                <input type="date" class="form-control" name="dob" id="dob" min="1900-01-01">
                                <div class="invalid-feedback"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>