<?php
    namespace Api\DB;

    class Sql{
        
        const HOST = 'localhost';
        const USER = 'root';
        const PASSWORD = '';
        const DBNAME =  'mailer';

        private $conn;

        /* 
            O construtor cria a conexão com o banco via PDO.

            Quando o método query é chamado, ele prepara o comando sql gerando um statement.
            (O statement é usado para chamar as funções de ligação dos parâmetros).
            Depois, o método chama a função que liga todos os parametros passados aos seus valores.
            (Essa função faz isso por meio do método bindParam, ou seja, chama esse método para cada parâmetro da query, passando chave e valor.)



        */

        public function __construct(){
            $this->conn = new \PDO(
                "mysql:dbname=".Sql::DBNAME.";host=".Sql::HOST, 
                Sql::USER,
                Sql::PASSWORD
            );
        }

        private function bindParam($statement, $key, $value){
            $statement->bindParam($key, $value);
        }

        private function setParams($statement, $parameters = []){
            foreach($parameters as $key => $value){
                $this->bindParam($statement, $key, $value);
            }
        }

        public function query($rawQuery, $parameters=[]){
            $statement = $this->conn->prepare($rawQuery);
            $this->setParams($statement, $parameters);
            $statement->execute();
            return $statement;
        }

        public function select($rawQuery, $parameters=[]){
            $statement = $this->query($rawQuery, $parameters);
            return $statement->fetchAll();
        } 
    }   
?>
