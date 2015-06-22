<div class="container">
    <div class="page-header">
        <h1>Информация о клиенте</h1>
    </div>

    <form
    <?php echo isset($client_id) ? "action=\"/clients/$client_id/edit\"" : 'action="/clients/create"'; ?>
    method="POST" class="form-horizontal js-form">

    <div class="form-group <?php echo isset($errors) ? '' : 'hidden'; ?>">
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo isset($errors) ? implode('<br>', $errors) : ''; ?>
        </div>
    </div>

    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">Имя</label>

        <div class="col-sm-4">
            <input type="text" id="inputName" name="name"
                   class="form-control js-name" data-toggle="tooltip"
                   maxlength="256" placeholder="Введите Ваше имя"
            <?php echo isset($name) ? "value=\"$name\"" : ''; ?>
            <?php echo isset($validationError) ? '' : 'autofocus'; ?>
            <?php echo isset($validationError) && $validationError[0] === 'name' ? "title=\"$validationError[1]\" autofocus" : ''; ?>
            >
        </div>
    </div>

    <div class="form-group">
        <label for="inputGender" class="col-sm-2 control-label">Пол</label>

        <div class="col-sm-4">
            <select id="inputGender" name="gender"
                    class="form-control js-gender" data-toggle="tooltip"
                    placeholder="Выберите Ваш пол"
                    <?php echo isset($validationError) && $validationError[0] === 'gender' ? "title=\"$validationError[1]\" autofocus" : ''; ?>
                    >
                <option value="1"
                <?php echo isset($gender) && $gender==='1' ? 'selected' : ''; ?>
                >Мужской</option>
                <option value="2"
                <?php echo isset($gender) && $gender==='2' ? 'selected' : ''; ?>
                >Женский</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputBirthday" class="col-sm-2 control-label">Дата рождения</label>

        <div class="col-sm-4">
            <input type="text" id="inputBirthday" name="birthday"
                   class="form-control js-birthday" data-toggle="tooltip"
                   placeholder="Введите Вашу дату рождения"
            <?php echo isset($birthday) ? 'value="' . date('d.m.Y', strtotime($birthday)) . '"' : ''; ?>
            <?php echo isset($validationError) && $validationError[0] === 'birthday' ? "title=\"$validationError[1]\" autofocus" : ''; ?>
            >
        </div>
    </div>
    <div class="form-group">
        <label for="inputPhone" class="col-sm-2 control-label">Телефон</label>

        <div class="col-sm-4">
            <input type="text" id="inputPhone" name="phone"
                   class="form-control js-phone" data-toggle="tooltip"
                   placeholder="Введите Ваш телефон"
            <?php echo isset($phone) ? "value=\"$phone\"" : ''; ?>
            <?php echo isset($validationError) && $validationError[0] === 'phone' ? "title=\"$validationError[1]\" autofocus" : ''; ?>
            >
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success" title="Сохранить">
                <span class="glyphicon glyphicon-ok"></span> Сохранить
            </button>
            <a href="/clients" class="btn btn-default" title="Вернуться к списку">
                <span class="glyphicon glyphicon-menu-left"></span> Вернуться к списку
            </a>
        </div>
    </div>
    </form>
</div>

