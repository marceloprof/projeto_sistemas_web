<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once './vendor/autoload.php';

    //Set Root Directory
    $basePath = explode('/', $_SERVER['SCRIPT_NAME']);
    $basePath = (empty($basePath[2])) ? null : '/'.$basePath[1];
    define('basePath', $basePath);

    //Set up Autoloading for Own Classes
    spl_autoload_register(function ($classname) {
        require_once ("./classes/" . $classname . ".php");
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
        $response = $this->view->render($response, "index.phtml");
        return $response;
    });

    $app->get('/teste', function (Request $request, Response $response, $args) {
        //$json = $request->getParsedBody();
        //$json['atributte']));
        $mapper = new TesteMapper($this->db);
        $data = $mapper->getTeste();

        return $response->withJson($data, 200);
    });

    $app->run();