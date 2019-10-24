<?php

class TankModel{

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

    public function getByName($name){
        $selectTankByName = "Select * FROM vasca WHERE Nome=:nameTank";
        $this->statement = $this->connection->prepare($selectTankByName);
        $this->statement->bindParam(':nameTank', $name , PDO::PARAM_STR);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function delete($name){
        $deleteTank = "DELETE FROM vasca WHERE Nome=:nameTank";
        $this->statement = $this->connection->prepare($deleteTank);
        $this->statement->bindParam(':nameTank', $name , PDO::PARAM_STR);
        $this->statement->execute();
    }

    public function add($tank){
        $addTank = "INSERT INTO vasca (nome,calcio,magnesio,kh,ultimo_cambio_acqua,Litri) VALUES (?,?,?,?,?,?)";
        $this->statement = $this->connection->prepare($addTank);
        $this->statement->bindParam(1, $tank[0]);
        $this->statement->bindParam(2, $tank[1]);
        $this->statement->bindParam(3, $tank[2]);
        $this->statement->bindParam(4, $tank[3]);
        $this->statement->bindParam(5, $tank[4]);
        $this->statement->bindParam(6, $tank[5]);
        $this->statement->execute();
    }

    public function modify($tank, $name){
        $modifyTank = "UPDATE vasca SET nome=:tankName, calcio=:calcio,magnesio=:magnesio,kh=:kh,ultimo_cambio_acqua=:waterChange,Litri=:liter WHERE nome=:orginalName";
        $this->statement = $this->connection->prepare($modifyTank);
        $this->statement->bindParam(':orginalName', $name , PDO::PARAM_STR);
        $this->statement->bindParam(':tankName', $tank[0] , PDO::PARAM_STR);
        $this->statement->bindParam(':calcio', $tank[1] , PDO::PARAM_STR);
        $this->statement->bindParam(':magnesio', $tank[2] , PDO::PARAM_STR);
        $this->statement->bindParam(':kh', $tank[3] , PDO::PARAM_STR);
        $this->statement->bindParam(':waterChange', $tank[4] , PDO::PARAM_STR);
        $this->statement->bindParam(':liter', $tank[5] , PDO::PARAM_STR);
        $this->statement->execute();
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