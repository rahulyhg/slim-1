<?php
require __DIR__ . '/../vendor/autoload.php';

/**
 * Waiting for PR to get accepted and this session_start will be removed
 * because the RKA\SessionMiddleware will register the session
 * https://github.com/slimphp/Slim-Csrf/pull/55
 */
session_start();

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

$app = new \Slim\App();

require 'container.php';
require 'middlewares.php';
require 'routes.php';

$app->run();