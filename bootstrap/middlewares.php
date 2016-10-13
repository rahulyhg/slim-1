<?php
/**
 * Note: The last middleware layer added is the first to be executed.
 * http://www.slimframework.com/docs/concepts/middleware.html
 */

$app->add(new App\Middlewares\RemoveTrailingSlash);