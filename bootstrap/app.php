<?php
require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

$app = new Slim\App();
$container = $app->getContainer();

require 'container/slim.php';
require 'container/middlewares.php';
require 'container/controllers.php';
require 'container/misc.php';
require 'middlewares.php';
require 'routes.php';

$app->run();
