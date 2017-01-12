<?php
/**
 * Note: The last middleware layer added is the first to be executed.
 * http://www.slimframework.com/docs/concepts/middleware.html
 */

$app->add(new App\Middlewares\OldInput($container));
$app->add(new App\Middlewares\CsrfViewField($container));
$app->add($container->csrf);
$app->add(new RKA\SessionMiddleware(['name' => 'session']));
$app->add(new App\Middlewares\RemoveTrailingSlash($container));
