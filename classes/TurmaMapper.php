<?php
    /**
    * Mapper da entidade Aluno
    */
    class AlunoMapper
    {
        private $idcadastroTurma;
        private $nome;
        private $cod;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function __destruct() {
            $this->pdo = null;
        }

        public function setIdCadastroAluno($idcadastroTurma) {
            $this->idcadastroAluno = $idcadastroTurma;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setCod($cod) {
            $this->RG = $cod;
        }

        public function getIdCadastroTurma() {
            return $this->idcadastroTurma;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getCod(){
            return $this->cod;
        }

        public function listarAluno() {
            $obj = $this->pdo->prepare('
                SELECT idcadastroTurma, nome, cod
                FROM cadastroTurma
                ORDER BY nome ASC');
            $obj->execute();
            try {
                $result = array("data" => $obj->fetchAll(),
                                          "type" => "SUCESS",
                                          "code" => 200);
            }
            catch(Exception $e) {
                $result = array("data" => $e->getMessage(),
                                         "type" => "ERROR",
                                         "code" => 400);
            }
            $obj = null;

            return $result;
        }

        public function cadastrarAluno() {
            $obj = $this->pdo->prepare("
                INSERT INTO cadastroTurma (nome, cod)
                VALUES (:nome, :cod)");
            $obj->execute(
                array(':nome' => $this->getNome(),
                          ':cod' => $this->getCod()));
            try {
                $result = array("data" => "Aluno cadastrado com sucesso.",
                                         "type" => "SUCESS",
                                         "code" => 200);
            }
            catch(Exception $e) {
                $result = array("data" => $e->getMessage(),
                                         "type" => "ERROR",
                                         "code" => 400);
            }
            $obj = null;

            return $result;
        }

        public function validarTurmaExiste() {
            $obj = $this->pdo->prepare("
                SELECT idcadastroTurma FROM cadastroTurma
                WHERE nome = :nome OR cod = :cod");
            $obj->execute(
                array(':nome' => $this->getNome(),
                          ':curso' => $this->getCurso()));
            try {
                if(count($obj->fetchAll()) > 0) {
                    $result = array("data" => "Turma já existente",
                                              "type" => "ERROR",
                                              "code" => 200);
                } else {
                    $result = array();
                }
            }
            catch(Exception $e) {
                $result = array("data" => $e->getMessage(),
                                          "type" => "ERROR",
                                          "code" => 400);
            }
            $obj = null;

            return $result;
        }

        public function excluirTurma() {
            $obj = $this->pdo->prepare("
                DELETE FROM cadastroTurma WHERE idcadastroTurma = :idcadastroTurma");
            $obj->execute(array(':idcadastroTurma' => $this->getIdCadastroTurma()));
            try {
                $result = array("data" => "Turma excluída com sucesso.",
                                          "type" => "SUCESS",
                                          "code" => 200);
            }
            catch(Exception $e) {
                $result = array("data" => $e->getMessage(),
                                          "type" => "ERROR",
                                          "code" => 400);
            }
            $obj = null;

            return $result;
        }

        public function converterData() {
            $date = explode('/', $this->getDataNascimento());
            $result = $date[2].'-'.$date[1].'-'.$date[0];

            return $result;
        }
    }
