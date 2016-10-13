<?php
require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

$app = new \Slim\App();

require 'container.php';
require 'middlewares.php';
require 'routes.php';

$app->run();