<?php
/** @var LessQL\Database */
$container['db'] = function () {
    $dns = sprintf("%s:dbname=%s;host=%s", env('DB_TYPE'), env('DB_NAME'), env('DB_HOST'));
    $user = env('DB_USER');
    $pass = env('DB_PASS');
    return new LessQL\Database(new PDO($dns, $user, $pass));
};

/** @var RKA\Session */
$container['session'] = function () {
    return new RKA\Session;
};