<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/disciplina/cadastrar', function (Request $request, Response $response, $args) {
        $response = $this->view->render($response, "cabecalho.phtml");
        $response = $this->view->render($response, "DisciplinaCadastrar.phtml");
        $response = $this->view->render($response, "rodape.phtml");

        return $response;
    });
	