<?php
namespace App\Middlewares;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class RemoveTrailingSlash
 * Removes trailing slash from URL with permanent redirect (301)
 */
class RemoveTrailingSlash extends Middleware
{
    /**
     * Invoke middleware
     *
     * @param  RequestInterface $request PSR7 request object
     * @param  ResponseInterface $response PSR7 response object
     * @param  callable $next Next middleware callable
     *
     * @return ResponseInterface PSR7 response object
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        $uri = $request->getUri();
        $path = $uri->getPath();

        if ($path != '/' && substr($path, -1) == '/') {
            $uri = $uri->withPath(substr($path, 0, -1));
            return $response->withRedirect((string)$uri, 301);
        }

        return $next($request, $response);
    }
}
