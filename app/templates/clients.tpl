<div class="container">
    <div class="page-header">
        <h1>Клиенты</h1>
    </div>

    <div class="col-lg-8 col-sm-10 col-xs-12">
        <div class="alert alert-warning alert-dismissible <?php echo isset($error) ? '' : 'hidden'; ?>" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo isset($error) ? $error : ''; ?>
        </div>

        <a href="/clients/create" class="btn btn-success btn-create" title="Добавить">
            <span class="glyphicon glyphicon-plus"></span> Добавить
        </a>
        <table class="table table-bordered">
            <tr>
                <th>Имя</th>
                <th>Пол</th>
                <th>Дата рождения</th>
                <th>Телефон</th>
                <th>Действие</th>
            </tr>

            <?php foreach ($clients as $client) { ?>
            <tr>
                <td><?php echo $client['name']; ?></td>
                <td><?php echo $client['gender'] === 1 ? 'Мужской' : 'Женский'; ?></td>

                <td><?php echo date('d.m.Y', strtotime($client['birthday'])); ?></td>
                <td><?php echo $client['phone']; ?></td>
                <td>
                    <a href="/clients/<?php echo $client['client_id']; ?>/edit" class="btn btn-primary"
                       title="Отредактировать">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <button class="btn btn-danger" title="Удалить"
                            data-href="/clients/<?php echo $client['client_id']; ?>/delete" data-toggle="modal"
                            data-target="#modalConfirmDelete">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>