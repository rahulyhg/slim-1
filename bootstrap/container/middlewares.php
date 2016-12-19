<?php
/** @var App\Middlewares\RemoveTrailingSlash */
$container['removeTrailingSlash'] = function ($container) {
    return new App\Middlewares\RemoveTrailingSlash($container);
};

/** @var RKA\SessionMiddleware */
$container['sessionMiddleware'] = function ($container) {
    return new RKA\SessionMiddleware(['name' => 'session']);
};

/** @var Slim\Csrf\Guard */
$container['csrf'] = function () {
    return new Slim\Csrf\Guard;
};

/** @var App\Middlewares\CsrfViewField */
$container['csrfViewField'] = function ($container) {
    return new App\Middlewares\CsrfViewField($container);
};

/** @var App\Middlewares\OldInput */
$container['oldInput'] = function ($container) {
    return new App\Middlewares\OldInput($container);
};
