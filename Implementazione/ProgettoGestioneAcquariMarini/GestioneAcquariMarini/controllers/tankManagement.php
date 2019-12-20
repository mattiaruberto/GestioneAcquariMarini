<?php

/**
 * Classe che gestisce tutto ciò che riguarda la pagina gestione vasche.
 */
class TankManagement{
    /**
     * Attributo rappresentante la classe TankModel
     */
    private $tankModel = null;
    /**
     * Attributo rappresentante la classe TankValidation
     */
    private $tankValidation = null;
    /**
     * Attributo rappresentante l'array dei dati dell'acquario.
     */
    private $arrayTank = null;
    /**
     * Metodo costruttore che istanzia le due classi.
     */
    public function __construct(){
        session_start();
        require_once "GestioneAcquariMarini/models/tankModel.php";
        require_once "GestioneAcquariMarini/models/tankValidation.php";
        $this->tankValidation = new TankValidation();
        $this->tankModel = new TankModel();
    }

    /**
     * Funzione che prepara la pagina del form alla modifica o all'aggiunta riempendo i campi nel caso della mdoifica o
     * no nel caso dell'aggiunta.
     * @param $pageInformation array contenente le informazioni della pagina da impostare.
     */
    public function requirePageForm($pageInformation){
        if ($_SESSION["authentification"]) {
            $title = $pageInformation[PAGE_TITLE];
            $nameButton = $pageInformation[NAME_BUTTON];
            $path = $pageInformation[PATH_BUTTON];
            $name = null;
            $stringErrors = null;
            if(count($pageInformation) >= 4){
                $stringErrors = $pageInformation[ERRORS_STRING];
            }
            if(count($pageInformation) >= 5){
                $name = $pageInformation[FORM_BENCHMARK_NAME];
            }

            if($this->arrayTank!=null){
                $tankName = $this->arrayTank[TANK_NAME];
                $calcium = $this->arrayTank[TANK_CALCIUM];
                $magnesium = $this->arrayTank[TANK_MAGNESIUM];
                $kh = $this->arrayTank[TANK_KH];
                $waterChange = $this->arrayTank[TANK_WATER_CHANGE];
                $liter = $this->arrayTank[TANK_LITER];
            }else if($name != null){
                $tankToModify = $this->tankModel->getByName($name);
                $tankName = $tankToModify[0][DB_TANK_NAME];
                $magnesium = $tankToModify[0][DB_TANK_MAGNESIUM];
                $calcium = $tankToModify[0][DB_TANK_CALCIUM];
                $kh = $tankToModify[0][DB_TANK_KH];
                $waterChange = $tankToModify[0][DB_TANK_WATER_CHANGE];
                $liter = $tankToModify[0][DB_TANK_LITER];
            }
            require "GestioneAcquariMarini/views/_templates/header.php";
            require "GestioneAcquariMarini/views/_templates/menu.php";
            require "GestioneAcquariMarini/views/gestioneAcquari/tank/tankManagement.php";
            require "GestioneAcquariMarini/views/_templates/footer.php";
        }else{
            header("Location:".URL);
        }
    }
    /**
     * Funzione index che fa il require della pagina gestione vasche di tutte le view.
     */
    public function index(){
        if($_SESSION["authentification"]){
            $aquariums = $this->tankModel->getAll();
            require "GestioneAcquariMarini/views/_templates/header.php";
            require "GestioneAcquariMarini/views/_templates/menu.php";
            require "GestioneAcquariMarini/views/gestioneAcquari/tank/index.php";
            require "GestioneAcquariMarini/views/_templates/footer.php";
        }else{
            header("Location:".URL);
        }
    }
    /**
     * Funzione che ti porta la form per l'aggiunta.
     */
    public function formAddTank(){
        if($_SESSION["type"] == "Admin") {
            $path=URL."tankManagement/addTank";
            $pageInformation = array("Aggiungi vasca", "Aggiungi", $path);
            $this->requirePageForm($pageInformation);
        }
    }
    /**
     * Funzone che ti porta al form per la modifica.
     * @param $name nome dell'acqaurio da mdoficare.
     */
    public function formModifyTank($name){
        $path = URL . "tankManagement/modifyTank/".$name;
        $pageInformation = array("Modifica vasca", "Modifica", $path, null, $name);
        $this->requirePageForm($pageInformation);
    }

    /**
     * Funzione che modifica la vasca che si vuole modificare.
     * @param $name nome dell'acquario da mdoficare.
     */
    public function modifyTank($name){
        $this->arrayTank = $this->getTankArray();
        if($this->tankValidation->validation($this->arrayTank, $name)){
            $this->tankModel->modify($this->arrayTank, $name);
            $this->arrayTank = null;
            if($_SESSION["authentification"]) {
                header("Location:" . URL . "tankManagement");
            }else{
                header("Location:".URL);
            }
        }else{
            $path = URL . "tankManagement/modifyTank/".$name;
            $stringErrors = $this->tankValidation->stringErrors;
            $pageInformation = array("Modifica vasca", "Modifica", $path, $stringErrors, $name);
            $this->requirePageForm($pageInformation);
        }
    }

    /**
     * Funzione che aggiunge la vasca sul databse tramite la funzione della classe UserModel.
     */
    public function addTank(){
        if($_SESSION["type"] == "Admin") {
            $this->arrayTank = $this->getTankArray();
            if ($this->tankValidation->validation($this->arrayTank)) {
                $this->tankModel->add($this->arrayTank);
                $this->arrayTank = null;
                if($_SESSION["authentification"]) {
                    header("Location:" . URL . "tankManagement");
                }else{
                    header("Location:".URL);
                }
            } else {
                $stringErrors = $this->tankValidation->stringErrors;
                $path = URL . "tankManagement/addTank";
                $pageInformation = array("Aggiungi vasca", "Aggiungi", $path, $stringErrors);
                $this->requirePageForm($pageInformation);
            }
        }else{
            header("Location:" . URL . HOME);
        }
    }
    /**
     * Funzione che cancella la vasca dal database.
     * @param $bowl nome della vasca da cancellare.
     */
    public function delete($bowl){
        if($_SESSION["authentification"]) {
            $this->tankModel->delete($bowl);
            header("Location:" . URL . "tankManagement");
        }else{
            header("Location:".URL);
        }
    }

    /**
     * Funzione che ritorna l'array ricavato dal form tramite il post.
     * @return array tank contenente i dati ricavati dal form tramite il post.
     */
    private function getTankArray(){
        $name = $this->tankValidation->generalValidation($_POST[TANK_NAME]);
        $magnesium = $this->tankValidation->generalValidation($_POST[TANK_MAGNESIUM]);
        $calcium = $this->tankValidation->generalValidation($_POST[TANK_CALCIUM]);
        $kh = $this->tankValidation->generalValidation($_POST[TANK_KH]);
        $waterChange = $this->tankValidation->generalValidation($_POST[TANK_WATER_CHANGE]);
        $liter = $this->tankValidation->generalValidation($_POST[TANK_LITER]);

        $tank = array(TANK_NAME=>$name, TANK_MAGNESIUM=>$magnesium, TANK_CALCIUM=>$calcium, TANK_KH=>$kh, TANK_WATER_CHANGE=>$waterChange, TANK_LITER=>$liter);
        return $tank;
    }
}
?>