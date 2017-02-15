<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/aluno/listar', function (Request $request, Response $response, $args) {
        $mapper = new AlunoMapper($this->db);
        $result = $mapper->listarAluno();
        return $response->withJson($result['data'], $result['code']);
    });