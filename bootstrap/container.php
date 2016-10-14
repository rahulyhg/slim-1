<?php
$container = $app->getContainer();

$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        $message = sprintf(
            "Type: %s | Code: %s | Message: %s | File: %s:%s | Trace: %s",
            get_class($exception),
            $exception->getCode(),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine(),
            $exception->getTraceAsString()
        );
        $container->logger->error($message);

        $handler = new Slim\Handlers\Error(env('DEBUG', true));

        return $handler($request, $response, $exception);
    };
};

$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        $statusCode = 404;
        $response = $response->withStatus($statusCode);
        return $container->view->render($response, 'error.twig', [
            'title' => 'Page Not Found',
            'message' => "<p>The page you are looking for could not be found.</p>",
            'code' => $statusCode
        ]);
    };
};

$container['notAllowedHandler'] = function ($container) {
    return function ($request, $response, $methods) use ($container) {
        $statusCode = 405;
        $response = $response
            ->withStatus($statusCode)
            ->withHeader('Allow', implode(', ', $methods));
        return $container->view->render($response, 'error.twig', [
            'title' => 'Method not allowed',
            'message' => "<p>Method must be one of: " . implode(', ', $methods)  ."</p>",
            'code' => $statusCode
        ]);
    };
};

/** @var Slim\Views\Twig */
$container['view'] = function ($container) {
    $view = new Slim\Views\Twig(__DIR__ . '/../app/Views/', [
        'cache' => __DIR__ . '/../tmp/views/',
        'debug' => env('DEBUG')
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container->request->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container->router, $basePath));
    $view->addExtension(new Twig_Extension_Debug());
    $view->addExtension(new App\Slim\TwigExtension());
    $view->getLoader()->addPath(realpath(__DIR__ . '/../public'));

    return $view;
};

/** @var Monolog\Logger */
$container['logger'] = function () {
    $logger = new Monolog\Logger('slim');
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler(__DIR__ . '/../logs/app.log', Monolog\Logger::DEBUG));
    return $logger;
};

/** @var Aura\Session\Session */
$container['session'] = function () {
    return (new \Aura\Session\SessionFactory)->newInstance($_COOKIE);
};