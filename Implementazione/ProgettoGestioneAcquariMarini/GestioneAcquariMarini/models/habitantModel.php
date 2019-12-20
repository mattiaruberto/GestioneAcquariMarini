<?php

class HabitantModel
{
    private $connection;
    private $statement;

    public function __construct()
    {
        require_once "database.php";
        $this->connection = new Database("gestioneacquarimarini");
    }

    public function getAllHabitantForTank($tankName)
    {
        $selectHabitants = "select * from abitante where nome_vasca=:tankName";
        $this->statement = $this->connection->prepare($selectHabitants);
        $this->statement->bindParam(':tankName', $tankName, PDO::PARAM_STR);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllHabitantBySpeciesAndSex($species, $sex)
    {
        $selectHabitants = "Select * FROM abitante WHERE specie=:species AND genere=:sex AND nome_vasca=:tankName";
        $this->statement = $this->connection->prepare($selectHabitants);
        $this->statement->bindParam(':species', $species, PDO::PARAM_STR);
        $this->statement->bindParam(':sex', $sex, PDO::PARAM_STR);
        $this->statement->bindParam(':tankName', $_SESSION["referencesTankName"], PDO::PARAM_STR);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function delete($species, $sex)
    {
        $selectHabitants = "DELETE FROM abitante WHERE specie=:species AND genere=:sex";
        $this->statement = $this->connection->prepare($selectHabitants);
        $this->statement->bindParam(':species', $species, PDO::PARAM_STR);
        $this->statement->bindParam(':sex', $sex, PDO::PARAM_STR);
        $this->statement->execute();
    }

    public function add($habitant)
    {
        $addHabitant = "INSERT INTO abitante (specie,genere,tipo,numero,nome_vasca) VALUES (?,?,?,?,?)";
        $this->statement = $this->connection->prepare($addHabitant);
        $this->statement->bindParam(1, $habitant["species"]);
        $this->statement->bindParam(2, $habitant["sex"]);
        $this->statement->bindParam(3, $habitant["type"]);
        $this->statement->bindParam(4, $habitant["habitantNumber"]);
        $this->statement->bindParam(5, $_SESSION["referencesTankName"]);
        $this->statement->execute();
    }

    public function modify($habitant, $species, $sex)
    {
        $modifyHabitant = "UPDATE abitante SET specie=:species, genere=:sex,tipo=:type,numero=:habitantNumber WHERE specie=:orginalSpecies && genere=:originalSex && nome_vasca=:tankName";
        $this->statement = $this->connection->prepare($modifyHabitant);
        $this->statement->bindParam(':orginalSpecies', $species, PDO::PARAM_STR);
        $this->statement->bindParam(':originalSex', $sex, PDO::PARAM_STR);
        $this->statement->bindParam(':species', $habitant['species'], PDO::PARAM_STR);
        $this->statement->bindParam(':sex', $habitant['sex'], PDO::PARAM_STR);
        $this->statement->bindParam(':type', $habitant['type'], PDO::PARAM_STR);
        $this->statement->bindParam(':habitantNumber', $habitant['habitantNumber'], PDO::PARAM_STR);
        $this->statement->bindParam(':tankName', $_SESSION["referencesTankName"], PDO::PARAM_STR);
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
