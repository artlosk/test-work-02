<?php
if (!isset($this->title)) $this->title = 'Панель администратора';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $this->title ?></title>

    <link href="/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/public/css/sb-admin.min.css" rel="stylesheet">

</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="/backend">Админ. панель</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item no-arrow mx-1">
            <a class="nav-link" href="/backend/default/logout">
                <i class="fa fa-fw fa-sign-out-alt"></i>
                <span class="nav-link-text">Выход</span>
            </a>
        </li>
    </ul>
</nav>

<div id="wrapper">
    <ul class="sidebar navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/backend/client/create">
                <i class="fa fa-fw fa-plus"></i>
                <span class="nav-link-text">Добавить</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/backend/client/index">
                <i class="fa fa-fw fa-users"></i>
                <span class="nav-link-text">Пользователи</span>
            </a>
        </li>
    </ul>

    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Page Content -->
            <h1><?= $this->title ?></h1>
            <hr>
            <?= $content ?>
        </div>
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © 2018</span>
                </div>
            </div>
        </footer>
    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="/public/js/jquery.min.js"></script>
<script src="/public/js/bootstrap.bundle.min.js"></script>
<script src="/public/js/jquery.easing.min.js"></script>
<script src="/public/js/sb-admin.min.js"></script>
<script src="/public/js/form.js"></script>

</body>

</html>

