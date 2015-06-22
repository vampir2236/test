<div class="container">
    <div class="page-header">
        <h1>Ошибка сервера</h1>
    </div>
    <div class="well <?php echo isset($message) ? '' : 'hidden'; ?>">
        <?php echo isset($message) ? $message : ''; ?>
    </div>
    <a class="btn btn-default" href="/">
        <span class="glyphicon glyphicon-menu-left"></span>
        Перейти на главную страницу
    </a>
</div>