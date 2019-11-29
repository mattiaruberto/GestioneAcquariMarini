<?php

class TankModel{
    private $connection;
    private $statement;

    public function __construct(){
        require_once "database.php";
        $this->connection = new Database("gestioneacquarimarini");
    }

    public function getAll(){
        $selectThank = "select * from vasca";
        $result = $this->executeAndFetchStatement($selectThank);
        return $result;
    }

    public function getAllTankName(){
        $selectThank = "select nome from vasca";
        $allName = $this->executeAndFetchStatement($selectThank);
        return $allName;
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
        $this->statement->bindParam(1, $tank["tankName"]);
        $this->statement->bindParam(2, $tank["calcium"]);
        $this->statement->bindParam(3, $tank["magnesium"]);
        $this->statement->bindParam(4, $tank["kh"]);
        $this->statement->bindParam(5, $tank["waterChange"]);
        $this->statement->bindParam(6, $tank["liter"]);
        $this->statement->execute();
    }

    public function modify($tank, $name){
        $modifyTank = "UPDATE vasca SET nome=:tankName, calcio=:calcium,magnesio=:magnesium,kh=:kh,ultimo_cambio_acqua=:waterChange,Litri=:liter WHERE nome=:orginalName";
        $this->statement = $this->connection->prepare($modifyTank);
        $this->statement->bindParam(':orginalName', $name , PDO::PARAM_STR);
        $this->statement->bindParam(':tankName', $tank['tankName'] , PDO::PARAM_STR);
        $this->statement->bindParam(':calcium', $tank['calcium'] , PDO::PARAM_STR);
        $this->statement->bindParam(':magnesium', $tank['magnesium'] , PDO::PARAM_STR);
        $this->statement->bindParam(':kh', $tank['kh'] , PDO::PARAM_STR);
        $this->statement->bindParam(':waterChange', $tank['waterChange'] , PDO::PARAM_STR);
        $this->statement->bindParam(':liter', $tank['liter'] , PDO::PARAM_STR);
        $this->statement->execute();
    }

    private function executeAndFetchStatement($select){
        $this->statement = $this->connection->prepare($select);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>