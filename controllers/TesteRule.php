<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/teste', function (Request $request, Response $response, $args) {
        //$json = $request->getParsedBody();
        //$json['atributte']));
        $mapper = new TesteMapper($this->db);
        $data = $mapper->getTeste();

        return $response->withJson($data, 200);
    });