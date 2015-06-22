<?php

spl_autoload_register(function ($class) {
    $filename = str_replace('\\', '/', __DIR__ . '\\' .  $class . '.php');
    if (file_exists($filename)) {
        require_once $filename;
    }
});

$config = require str_replace('\\', '/', __DIR__ . '\config\app.php');
$app = new core\App($config);

$app->get('/', 'controllers\Client', 'getIndex');
$app->get('/clients', 'controllers\Client', 'getIndex');
$app->get('/clients/create', 'controllers\Client', 'getCreate');
$app->post('/clients/create', 'controllers\Client', 'postCreate');
$app->get('/clients/:digit/edit', 'controllers\Client', 'getEdit');
$app->post('/clients/:digit/edit', 'controllers\Client', 'postEdit');
$app->get('/clients/:digit/delete', 'controllers\Client', 'getDelete');

$app->run();