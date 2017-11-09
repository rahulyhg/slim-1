<?php
namespace App\Slim;

use Twig_Extension;
use Twig_SimpleFunction;

class TwigExtension extends Twig_Extension
{
    public function getName()
    {
        return 'app';
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('env', function ($key) {
                return env($key);
            }),
            new Twig_SimpleFunction('old', function ($key, $default = '') {
                $old = $this->container->session->old;
                return isset($old[$key]) ? $old[$key] : $default;
            }),
            new Twig_SimpleFunction('year', function () {
                return date('Y');
            }),
        ];
    }

    public function getFilters()
    {
        return [
        ];
    }
}
