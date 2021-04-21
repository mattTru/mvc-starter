<?php 
namespace App\Controllers;

class Controller {

  protected $twig;

  function __construct()
  {
    global $twig;
    $this->twig = $twig;
  }
}
