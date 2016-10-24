<?php
namespace App\Controllers;

class IndexController extends Controller
{
    public function __invoke($request, $response, $args)
    {
        return $this->response($response)->render('index');
    }
}