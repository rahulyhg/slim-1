<?php
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';
} else {
    die('Missing vendor. You should run "composer install"');
}

try {
    $dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
    $dotenv->load();
} catch(Exception $e) {}

$app = new Slim\App();
$container = $app->getContainer();

require 'container.php';
require 'middlewares.php';
require 'routes.php';

$app->run();
