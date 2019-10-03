<?php

class Acquarimodel{

    private $connection;
    private $statement;


    public function __construct()
    {
        require_once "database.php";
        $this->connection = new Database("gestioneacquarimarini");
    }

    public function getAll(){
        $selectThank = "select * from vasca";
        $result = $this->executeAndFetchStatement($selectThank);
        return $result;
    }

    public function getNameLitrage(){
        $selectThank = "select Nome,Litraggio from vasca";
        $result = $this->executeAndFetchStatement($selectThank);
        return $result;
    }

    private function executeAndFetchStatement($select)
    {
        $this->statement = $this->connection->prepare($select);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>