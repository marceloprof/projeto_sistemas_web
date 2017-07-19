<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/turma/cadastrar', function (Request $request, Response $response, $args) {
        $response = $this->view->render($response, "cabecalho.phtml");
        $response = $this->view->render($response, "TurmaCadastrar.phtml");
        $response = $this->view->render($response, "rodape.phtml");

        return $response;
    });

    $app->get('/turma/listar', function (Request $request, Response $response, $args) {
        $mapper = new TurmaMapper($this->db);
        $result = $mapper->listarTurma();
        if(count($result['data']) > 0) {
            $data = json_encode($result['data']);
        }
        $response = $this->view->render($response, "cabecalho.phtml");
        $response = $this->view->render($response, "TurmaListar.phtml",  ["data" => $data]);
        $response = $this->view->render($response, "rodape.phtml");

        return $response;
    });

    $app->post('/turma/salvar', function (Request $request, Response $response) {
        $form = $request->getParsedBody();

        $mapper = new TurmaMapper($this->db);
        $mapper->setNome(filter_var($form['nome'], FILTER_SANITIZE_STRING));
        $mapper->setCod(filter_var($form['cod'], FILTER_SANITIZE_STRING));
        
        $error = $mapper->validarTurma();
        if(count($error) == 0) {
            $data = $mapper->cadastrarTurma();
        } else {
            $data = $error;
        }
        
        $response = $this->view->render($response, "cabecalho.phtml");
        $response = $this->view->render($response, "TurmaCadastrar.phtml",  ["data" => $data]);
        $response = $this->view->render($response, "rodape.phtml");

        return $response;
    });

    $app->get('/turma/excluir/{id}', function (Request $request, Response $response, $args) {
        $mapper = new TurmaMapper($this->db);
        $mapper->setIdCadastroTurma((int)$args['id']);
        $data = $mapper->excluirTurma();

        return $response->withRedirect(basePath.'/turma/listar');
    });