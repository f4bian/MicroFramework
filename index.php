<?php
/**
 * This file is used as bootstrap and index file
 */
require_once __DIR__ . "/vendor/autoload.php";

use App\App;

$app = new App;

$container = $app->getContainer();

$container['config'] = function () {
    return [
        'db_driver' => 'mysql',
        'db_host' => 'localhost',
        'db_name' => 'miniframework',
        'db_user' => 'homestead',
        'db_password' => 'secret',
    ];
};

$container['db'] = function ($c) {
    return new PDO(
        $c->config['db_driver'] . ':host=' . $c->config['db_host'] . ';dbname=' . $c->config['db_name'],
        $c->config['db_user'],
        $c->config['db_password']
    );
};
