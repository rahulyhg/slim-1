<?php
namespace App\Controllers;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Controller
{
    /**
     * @var ContainerInterface
     */
    protected $container;
    /**
     * @var ServerRequestInterface
     */
    protected $request;
    /**
     * @var ResponseInterface
     */
    protected $response;
    /**
     * @var
     */
    private $data = [];

    /**
     * @param ContainerInterface $ci
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->registerGlobalViewData();
    }

    /**
     * @param ServerRequestInterface $request
     * @return $this
     */
    protected function request(ServerRequestInterface $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @param ResponseInterface $response
     * @return $this
     */
    protected function response(ResponseInterface $response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @param $template
     * @return mixed
     */
    protected function render($template)
    {
        $ext = '.twig';
        $template = substr($template, -strlen($ext)) === $ext ? $template : $template . $ext;

        return $this->container->view->render($this->response, $template, $this->getData());
    }

    /**
     * @param null $key
     * @return array
     */
    protected function getData($key = null)
    {
        if ($key) {
            return isset($this->data[$key]) ? $this->data[$key] : null;
        }

        return $this->data;
    }

    /**
     * @param $key
     * @param null $value
     * @return $this
     */
    protected function setData($key, $value = null)
    {
        if (!is_array($key)) {
            $key = [$key => $value];
        }

        foreach ($key as $k => $v) {
            $this->data[$k] = $v;
        }

        return $this;
    }

    /**
     * Global templates data
     */
    private function registerGlobalViewData()
    {
//        $this->setData('csrf', $this->container->session->getCsrfToken()->getValue());
    }
}