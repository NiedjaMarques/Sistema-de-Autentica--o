<?php
    require_once 'app/controller/AuthController.php';
    require_once 'app/controller/UserController.php';
    require_once 'core/Router.php';

    $router = new Router();
    $router->add('/', 'AuthController@loginForm');
    $router->add('/login', 'AuthController@loginForm');
    $router->add('/login/submit', 'AuthController@login');
    $router->add('/sair', 'AuthController@logout');
    $router->add('/welcome', 'AuthController@bemvindo'); 
    $router->add('/cadastro' , 'UserController@cadastrForm');
    $router->add('/cadastro/submit', 'UserController@cadastrar');
    
    $uri = $_SERVER['REQUEST_URI'];
    $router->dispatch($uri);    
?>

