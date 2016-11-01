<?php
namespace App\Middlewares;

use Interop\Container\ContainerInterface;

/**
 * Class Middleware
 */
class Middleware
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
