<?php
//
// FILE : mvc-app/Controllers/HomeController.php
//
namespace App\Controllers;

use App\Models\Base;

class HomeController extends Controller
{
    public function index()
    {
        $this->twig->display(
            'index.html.twig',
            []
        );
    }
}
