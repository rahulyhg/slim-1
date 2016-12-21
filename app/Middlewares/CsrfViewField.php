<?php
namespace App\Middlewares;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class CsrfViewField
 * Adds global variable for CSRF filed to the views
 * User as {{ csrf.field | raw }}
 */
class CsrfViewField extends Middleware
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
        $nameKey = $this->container->csrf->getTokenNameKey();
        $nameValue = $this->container->csrf->getTokenName();
        $tokenKey = $this->container->csrf->getTokenValueKey();
        $tokenValue = $this->container->csrf->getTokenValue();

        $this->container->view->getEnvironment()->addGlobal('csrf', [
            'field' => '
                <input type="hidden" name="' . $nameKey . '" value="' . $nameValue . '">
                <input type="hidden" name="' . $tokenKey . '" value="' . $tokenValue . '">
            '
        ]);

        return $next($request, $response);
    }
}
