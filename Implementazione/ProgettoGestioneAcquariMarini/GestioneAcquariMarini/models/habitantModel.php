<?php

/**
 * Classe HabitantModel che gestisce tutte le azioni sul database per l'abitante.
 */
class HabitantModel{
    /**
     * Attributo che rappresenta la classe database.
     */
    private $connection;
    /**
     * Attributo che rappresente tutto ciò che riguarda la query al database.
     */
    private $statement;
    /**
     * Metodo costruttore dove viene istanziato il database.
     */
    public function __construct(){
        require_once "database.php";
        $this->connection = new Database(DB_NAME);
    }
    /**
     * Metodo che ritorna tutti gli abitanti dell'acqaurio salvati sul database.
     * @param $tankName Nome dell'acqaurio
     * @return array array di acquari ricavato dal database
     */
    public function getAllHabitantForTank($tankName){
        $selectHabitants = "select * from abitante where nome_vasca=:tankName";
        $this->statement = $this->connection->prepare($selectHabitants);
        $this->statement->bindParam(':tankName', $tankName, PDO::PARAM_STR);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * Funzione che cerca in base alla specie e al sesso un abitante dell'acquario.
     * @param $species specie dell'abitante
     * @param $sex sesso dell'abitante
     * @return array array di acquari ricavato dal database
     */
    public function getAllHabitantBySpeciesAndSex($species, $sex){
        $selectHabitants = "Select * FROM abitante WHERE specie=:species AND genere=:sex AND nome_vasca=:tankName";
        $this->statement = $this->connection->prepare($selectHabitants);
        $this->statement->bindParam(':species', $species, PDO::PARAM_STR);
        $this->statement->bindParam(':sex', $sex, PDO::PARAM_STR);
        $this->statement->bindParam(':tankName', $_SESSION["referencesTankName"], PDO::PARAM_STR);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * Funzione che cancella l'abitante dell'acquario dal database
     * @param $species specie dell'abitante
     * @param $sex sesso dell'abitante
     */
    public function delete($species, $sex){
        $selectHabitants = "DELETE FROM abitante WHERE specie=:species AND genere=:sex";
        $this->statement = $this->connection->prepare($selectHabitants);
        $this->statement->bindParam(':species', $species, PDO::PARAM_STR);
        $this->statement->bindParam(':sex', $sex, PDO::PARAM_STR);
        $this->statement->execute();
    }
    /**
     * Funzione che aggiunge un abitante al database
     * @param $habitant array abitante che contiene tutti i dati da aggiungere.
     */
    public function add($habitant)
    {
        $addHabitant = "INSERT INTO abitante (specie,genere,tipo,numero,nome_vasca) VALUES (?,?,?,?,?)";
        $this->statement = $this->connection->prepare($addHabitant);
        $this->statement->bindParam(1, $habitant[HABITANT_SPECIES]);
        $this->statement->bindParam(2, $habitant[HABITANT_SEX]);
        $this->statement->bindParam(3, $habitant[HABITANT_TYPE]);
        $this->statement->bindParam(4, $habitant[HABITANT_NUMBER]);
        $this->statement->bindParam(5, $_SESSION["referencesTankName"]);
        $this->statement->execute();
    }
    /**
     * Funzione che mofica i dati dell'abitante
     * @param $habitant array con i dati dell'abitante modificate
     * @param $species la specie dell'abitante prima di modificarlo per riconoscerlo.
     * @param $sex sesso dell'abitante prima di modificarlo per riconoscerlo.
     */
    public function modify($habitant, $species, $sex){
        $modifyHabitant = "UPDATE abitante SET specie=:species, genere=:sex,tipo=:type,numero=:number WHERE specie=:orginalSpecies && genere=:originalSex && nome_vasca=:tankName";
        $this->statement = $this->connection->prepare($modifyHabitant);
        $this->statement->bindParam(':orginalSpecies', $species, PDO::PARAM_STR);
        $this->statement->bindParam(':originalSex', $sex, PDO::PARAM_STR);
        $this->statement->bindParam(':species', $habitant[HABITANT_SPECIES], PDO::PARAM_STR);
        $this->statement->bindParam(':sex', $habitant[HABITANT_SEX], PDO::PARAM_STR);
        $this->statement->bindParam(':type', $habitant[HABITANT_TYPE], PDO::PARAM_STR);
        $this->statement->bindParam(':number', $habitant[HABITANT_NUMBER], PDO::PARAM_STR);
        $this->statement->bindParam(':tankName', $_SESSION["referencesTankName"], PDO::PARAM_STR);
        $this->statement->execute();
    }
    /**
     * Funzione che ritorna da un'array multidimensionale un array normale contenente i dati dell'abitante.
     * @param $habitant array abitante multidimensionale.
     * @return array array normale dell'abitante.
     */
    public function getHabitantByDatabase($habitant){
        $species = $habitant[0][DB_HABITANT_SPECIES];
        $sex = $habitant[0][DB_HABITANT_SEX];
        $type = $habitant[0][DB_HABITANT_TYPE];
        $habitantNumber = $habitant[0][DB_HABITANT_NUMBER];
        $habitant = array(HABITANT_SPECIES=>$species,HABITANT_SEX=>$sex,HABITANT_TYPE=>$type,HABITANT_NUMBER=>$habitantNumber);
        return $habitant;
    }
    /**
     * Funzione che esegue la query e fa il fetch del risultato.
     * @param $select query da eseguire.
     * @return array array contenente i risultati.
     */
    private function executeAndFetchStatement($select){
        $this->statement = $this->connection->prepare($select);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
