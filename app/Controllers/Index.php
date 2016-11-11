<?php
namespace App\Controllers;

class Index extends Controller
{
    public function index($request, $response, $args)
    {
        return $this->response($response)->render('index');
    }
}