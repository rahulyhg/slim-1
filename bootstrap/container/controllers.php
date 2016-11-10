<?php
/** @var App\Controllers\Index */
$container['IndexController'] = function ($container) {
    return new App\Controllers\Index($container);
};