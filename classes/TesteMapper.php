<?php

    /**
    * Mapper da entidade Teste
    */
    class TesteMapper
    {
        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function __destruct() {
            $this->pdo = null;
        }

        public function getTeste($params) {

            $obj = $this->pdo->prepare('
                SELECT * FROM teste',
                array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY)
            );

            $obj->execute();

            $result = $obj->fetchAll();
            $obj = null;

            return $result;
        }
    }
