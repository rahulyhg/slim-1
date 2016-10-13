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
            })
        ];
    }

    public function getFilters()
    {
        return [
        ];
    }
}