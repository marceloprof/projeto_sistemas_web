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
        $mapper = new AlunoMapper($this->db);
        $result = $mapper->listarAluno();
        if(count($result['data']) > 0) {
            $data = json_encode($result['data']);
        }
        $response = $this->view->render($response, "cabecalho.phtml");
        $response = $this->view->render($response, "AlunoListar.phtml",  ["data" => $data]);
        $response = $this->view->render($response, "rodape.phtml");

        return $response;
    });

    $app->post('/turma/salvar', function (Request $request, Response $response) {
        $form = $request->getParsedBody();

        $mapper = new AlunoMapper($this->db);
        $mapper->setNome(filter_var($form['nome'], FILTER_SANITIZE_STRING));
        $mapper->setRG(filter_var($form['RG'], FILTER_SANITIZE_STRING));
        $mapper->setDataNascimento(filter_var($form['dataNascimento'], FILTER_SANITIZE_STRING));
        $mapper->setCurso(filter_var($form['curso'], FILTER_SANITIZE_STRING));
        $error = $mapper->validarAluno();
        if(count($error) == 0) {
            $data = $mapper->cadastrarAluno();
        } else {
            $data = $error;
        }
        $response = $this->view->render($response, "cabecalho.phtml");
        $response = $this->view->render($response, "AlunoCadastrar.phtml",  ["data" => $data]);
        $response = $this->view->render($response, "rodape.phtml");

        return $response;
    });

    $app->get('/turma/excluir/{id}', function (Request $request, Response $response, $args) {
        $mapper = new AlunoMapper($this->db);
        $mapper->setIdCadastroAluno((int)$args['id']);
        $data = $mapper->excluirAluno();

        return $response->withRedirect(basePath.'/aluno/listar');
    });