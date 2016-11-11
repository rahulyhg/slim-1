<?php
namespace App\Middlewares;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class OldInput
 * Persist old input values
 */
class OldInput extends Middleware
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
        $this->container->view->getEnvironment()->addGlobal('old', $this->container->session->old);
        $this->container->session->old = $request->getParams();

        return $next($request, $response);
    }
}
