<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once '../vendor/autoload.php';

    //Set up Autoloading for Own Classes
    spl_autoload_register(function ($classname) {
        require_once ("../classes/" . $classname . ".php");
    });

    //Add Config Settings
    require_once '../controllers/config.php';

    $app = new \Slim\App(["settings" => $config]);

    //Add Container
    $container = $app->getContainer();
    require_once '../controllers/container.php';

    //Add Views and Templates
    $container['view'] = new \Slim\Views\PhpRenderer("../templates/");

    //Add Rules
    $app->get('/', function (Request $request, Response $response) {
        $response = $this->view->render($response, "index.phtml");
        return $response;
    });

    $app->get('/service/{service}', function (Request $request, Response $response, $args) {

        $json = $request->getParsedBody();
        $data = null;

        $mapper = new TesteMapper($this->db);
        $data = $mapper->getTeste();
        if(count($data) == 0){
            $data = $args;
        }

        //$response->header('Content-Type', 'application/json;charset=utf-8');
        return $response->withJson($data, 200);

    });

    $app->run();