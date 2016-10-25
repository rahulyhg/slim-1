<?php

$app->get('/', 'IndexController')->setName('index');
$app->get('/test', 'IndexController')->setName('test');