<?php
/* @var $pagination string */
/* @var $list array */
$this->title = 'Список пользователей';
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?= $this->title ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <?php if (empty($list)): ?>
                            <p>Список пользователей пуст</p>
                        <?php else: ?>
                            <table class="table">
                                <tr>
                                    <th>
                                        <a href="/backend/client/index?page=<?= $page ?>&sort=<?= $sort ?>&order=<?= $order ?>">Логин</a>
                                    </th>
                                    <th>
                                        <a href="/backend/client/index?page=<?= $page ?>&sort=<?= $sort ?>&order=<?= $order ?>">Имя</a>
                                    </th>
                                    <th>
                                        <a href="/backend/client/index?page=<?= $page ?>&sort=<?= $sort ?>&order=<?= $order ?>">Фамилия</a>
                                    </th>
                                    <th colspan="3">Действие</th>
                                </tr>
                                <?php foreach ($list as $val): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($val['login'], ENT_QUOTES); ?></td>
                                        <td><?php echo htmlspecialchars($val['firstname'], ENT_QUOTES); ?></td>
                                        <td><?php echo htmlspecialchars($val['lastname'], ENT_QUOTES); ?></td>
                                        <td>
                                            <a href="/backend/client/view/<?php echo $val['id']; ?>"
                                               class="btn btn-info">
                                                <span class="fa fa-eye"></span>
                                                Просмотр
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/backend/client/update/<?php echo $val['id']; ?>"
                                               class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                                Редактировать
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/backend/client/delete/<?php echo $val['id']; ?>"
                                               class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                                Удалить
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php echo $pagination; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>