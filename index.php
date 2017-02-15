<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once './vendor/autoload.php';

    //Set Root Directory
    $basePath = explode('/', $_SERVER['SCRIPT_NAME']);
    $basePath = (empty($basePath[2])) ? null : '/'.$basePath[1];
    define('basePath', $basePath);

    //Set up Autoloading for Classes
    spl_autoload_register(function ($classe) {
        require_once ("./classes/" . $classe . ".php");
    });

    //Add Config Settings
    require_once './controllers/config.php';
    $app = new \Slim\App(["settings" => $config]);

    //Add Container
    $container = $app->getContainer();
    require_once './controllers/container.php';

    //Add Views and Templates
    $container['view'] = new \Slim\Views\PhpRenderer("./templates/");

    //Add Rules
    $app->get('/', function (Request $request, Response $response) {
        $response = $this->view->render($response, "cabecalho.phtml");
        $response = $this->view->render($response, "index.phtml");
        $response = $this->view->render($response, "rodape.phtml");
        return $response;
    });
    require_once './controllers/TesteRule.php';
    require_once './controllers/AlunoRule.php';

    $app->run();