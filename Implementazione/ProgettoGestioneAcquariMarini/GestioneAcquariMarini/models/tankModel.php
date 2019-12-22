<?php
/**
 * Classe TankModel che gestisce tutte le azioni sul database per gli acquari.
 */
class TankModel{
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
     * Metodo che ritorna tutte le vasche sul database.
     * @return array array di vasche.
     */
    public function getAll(){
        $selectThank = "select * from vasca";
        $result = $this->executeAndFetchStatement($selectThank);
        return $result;
    }
    /**
     * Metodo che ritorna tutti i nomi delle vasche presenti sul database.
     * @return array array di tutti i nomi delle vasche
     */
    public function getAllTankName(){
        $selectThank = "select nome from vasca";
        $allName = $this->executeAndFetchStatement($selectThank);
        return $allName;
    }
    /**
     * Metodo che ritorna la vasca in base al suo nome.
     * @param $name nome della vasca da cercare.
     * @return array array contenente i dati della vasca.
     */
    public function getByName($name){
        $selectTankByName = "Select * FROM vasca WHERE Nome=:nameTank";
        $this->statement = $this->connection->prepare($selectTankByName);
        $this->statement->bindParam(':nameTank', $name , PDO::PARAM_STR);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * Metodo che cancella una vasca.
     * @param $name nome della vasca da cancellare.
     */
    public function delete($name){
        $deleteHabitantTank = "DELETE FROM abitante WHERE nome_vasca=:nameTank";
        $this->statement = $this->connection->prepare($deleteHabitantTank);
        $this->statement->bindParam(':nameTank', $name , PDO::PARAM_STR);
        $this->statement->execute();
        $deleteTank = "DELETE FROM vasca WHERE Nome=:nameTank";
        $this->statement = $this->connection->prepare($deleteTank);
        $this->statement->bindParam(':nameTank', $name , PDO::PARAM_STR);
        $this->statement->execute();
    }
    /**
     * Metodo che aggiunge una vasca sul database.
     * @param $tank array contenente i dati da aggiungere della vasca.
     */
    public function add($tank){
        $addTank = "INSERT INTO vasca (nome,calcio,magnesio,kh,ultimo_cambio_acqua,Litri) VALUES (?,?,?,?,?,?)";
        $this->statement = $this->connection->prepare($addTank);
        $this->statement->bindParam(1, $tank[TANK_NAME]);
        $this->statement->bindParam(2, $tank[TANK_CALCIUM]);
        $this->statement->bindParam(3, $tank[TANK_MAGNESIUM]);
        $this->statement->bindParam(4, $tank[TANK_KH]);
        $this->statement->bindParam(5, $tank[TANK_WATER_CHANGE]);
        $this->statement->bindParam(6, $tank[TANK_LITER]);
        $this->statement->execute();
    }
    /**
     * Metodo che modifica la vasca.
     * @param $tank array contenente i dati da modificare della vasca.
     * @param $name nome originario della vasca per identificarla.
     */
    public function modify($tank, $name){
        $modifyTank = "UPDATE vasca SET nome=:tankName, calcio=:calcium,magnesio=:magnesium,kh=:kh,ultimo_cambio_acqua=:waterChange,Litri=:liter WHERE nome=:orginalName";
        $this->statement = $this->connection->prepare($modifyTank);
        $this->statement->bindParam(':orginalName', $name , PDO::PARAM_STR);
        $this->statement->bindParam(':tankName', $tank[TANK_NAME] , PDO::PARAM_STR);
        $this->statement->bindParam(':calcium', $tank[TANK_CALCIUM] , PDO::PARAM_STR);
        $this->statement->bindParam(':magnesium', $tank[TANK_MAGNESIUM] , PDO::PARAM_STR);
        $this->statement->bindParam(':kh', $tank[TANK_KH] , PDO::PARAM_STR);
        $this->statement->bindParam(':waterChange', $tank[TANK_WATER_CHANGE] , PDO::PARAM_STR);
        $this->statement->bindParam(':liter', $tank[TANK_LITER] , PDO::PARAM_STR);
        $this->statement->execute();
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
?>