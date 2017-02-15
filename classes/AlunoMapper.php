<?php
    /**
    * Mapper da entidade Aluno
    */
    class AlunoMapper
    {
        private $idcadastroAluno;
        private $nome;
        private $RG;
        private $dataNascimento;
        private $curso;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function __destruct() {
            $this->pdo = null;
        }

        public function setIdCadastroAluno($idcadastroAluno) {
            $this->idcadastroAluno = $idcadastroAluno;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setRG($RG) {
            $this->RG = $RG;
        }

        public function setDataNascimento($dataNascimento) {
            $this->dataNascimento = $dataNascimento;
        }

        public function setCurso($curso) {
            $this->curso = $curso;
        }

        public function getIdCadastroAluno() {
            return $this->idcadastroAluno;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getRG(){
            return $this->RG;
        }

        public function getDataNascimento() {
            return $this->dataNascimento;
        }

        public function getCurso() {
            return $this->curso;
        }

        public function listarAluno() {
            $obj = $this->pdo->prepare('
                SELECT idcadastroAluno, nome, RG, curso,
                    DATE_FORMAT(dataNascimento, "%d/%m/%Y") AS dataNascimento
                FROM cadastroAluno
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
                INSERT INTO cadastroAluno (nome, RG, dataNascimento, curso)
                VALUES (:nome, :RG, :dataNascimento, :curso)");
            $obj->execute(
                array(':nome' => $this->getNome(),
                          ':RG' => $this->getRG(),
                          ':dataNascimento' => $this->converterData(),
                          ':curso' => $this->getCurso()));
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

        public function validarAluno() {
            $obj = $this->pdo->prepare("
                SELECT idcadastroAluno FROM cadastroAluno
                WHERE nome = :nome AND curso = :curso");
            $obj->execute(
                array(':nome' => $this->getNome(),
                          ':curso' => $this->getCurso()));
            try {
                if(count($obj->fetchAll()) > 0) {
                    $result = array("data" => "Aluno já existente no Curso.",
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

        public function excluirAluno() {
            $obj = $this->pdo->prepare("
                DELETE FROM cadastroAluno WHERE idcadastroAluno = :idcadastroAluno");
            $obj->execute(array(':idcadastroAluno' => $this->getIdCadastroAluno()));
            try {
                $result = array("data" => "Aluno excluído com sucesso.",
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
