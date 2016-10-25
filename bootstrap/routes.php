<?php

$app->get('/', '\App\Controllers\IndexController')->setName('index');
$app->get('/test', '\App\Controllers\IndexController')->setName('test');