<?php
/**
 * Note: The last middleware layer added is the first to be executed.
 * http://www.slimframework.com/docs/concepts/middleware.html
 */

$app->add($container->oldInput);
$app->add($container->csrfViewField);
$app->add($container->csrf);
$app->add($container->sessionMiddleware);
$app->add($container->removeTrailingSlash);