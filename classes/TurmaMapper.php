<?php
    /**
    * Mapper da entidade Aluno
    */
    class TurmaMapper
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

        public function setIdCadastroTurma($idcadastroTurma) {
            $this->idcadastroTurma = $idcadastroTurma;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setCod($cod) {
            $this->cod = $cod;
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

        public function listarTurma() {
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

        public function cadastrarTurma() {
            $obj = $this->pdo->prepare("
                INSERT INTO cadastroTurma (nome, cod)
                VALUES (:nome, :cod)");
            $obj->execute(
                array(':nome' => $this->getNome(),
                          ':cod' => $this->getCod()));
            try {
                $result = array("data" => "Turma cadastrado com sucesso.",
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

        public function validarTurma() {
            $obj = $this->pdo->prepare("
                SELECT idcadastroTurma FROM cadastroTurma
                WHERE nome = :nome OR cod = :cod");
            $obj->execute(
                array(':nome' => $this->getNome(),
                          ':cod' => $this->getCod()));
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
