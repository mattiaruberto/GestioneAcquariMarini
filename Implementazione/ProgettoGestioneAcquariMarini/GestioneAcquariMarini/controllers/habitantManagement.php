<?php
session_start();

/**
 * La seguente classe controller gestisce tutto ciò che riguarda la pagina gestione abitanti, dall'aggiunta, alla
 * modifica, alla rimozione e al mostrare gli abitanti della vasca.
 */
class HabitantManagement{
    /*
     * Attributo contenente gli errori nella gestione dell'abitante quando viene aggiunto o modificato.
     */
    private $stringErrors;
    /**
     * Attributo che rappresenta la classe HabitantModel.
     */
    private $habitantModel;
    /**
     * Attributo rappresentante la classe HabitantValidation.
     */
    private $habitantValidation;
    /**
     * Attributo rappresentante la classse TankValidation.
     */
    private $tankValidation;
    /**
     * Attributo contenente l'array di abitanti usato per la gestione, aggiunta e modifica.
     */
    private $habitantArrayManagement = null;
    /**
     * Attributo che contiene il testo da stampare nel bottone della pagina.
     */
    private $textButtonForm = "Aggiungi";
    /**
     * Attributo che rappresenta il percorso da azionare quando viene schiacciato il bottone submit del form.
     */
    private $pathForm = URL . "habitantManagement/addHabitant";

    /**
     * Metodo costruttore che istanzia gli oggetti HabitantValidation TankValidation e HabitantModel.
     */
    public function __construct(){
        require_once "GestioneAcquariMarini/models/habitantModel.php";
        require_once "GestioneAcquariMarini/models/habitantValidation.php";
        require_once "GestioneAcquariMarini/models/tankValidation.php";
        $this->habitantValidation = new HabitantValidation();
        $this->tankValidation = new TankValidation();
        $this->habitantModel = new HabitantModel();
    }

    /**
     * Metodo richiamata quando l'URL punta solo al controller, in questo caso ti riporta alla pagina di gestione
     * delle vasche.
     */
    public function index(){
        if ($_SESSION["authentification"]) {
            header("Location:" . URL . "tankManagement");
        } else {
            header("Location:" . URL);
        }
    }

    /**
     * Funzione che prepara i parametri come nome del bottone, dati da inseirire nel form o da modificare e crea la
     * variabile contenente tutti gli abitanti che poi verrà utilizzata per riempire la tabella.
     * @param int $referenceTankName nome dell'acqaurio di cui si sta gestendo gli abitati.
     */
    function showTankHabitants($referenceTankName = 1){
        $path = $this->pathForm;
        if ($_SESSION["authentification"] && strlen($referenceTankName) > 0 && $referenceTankName != 1) {
            if ($this->tankValidation->validateTankName($referenceTankName)) {
                $_SESSION["referencesTankName"] = $referenceTankName;
                $habitants = $this->habitantModel->getAllHabitantForTank($_SESSION["referencesTankName"]);
                $nameButton = $this->textButtonForm;
                $stringErrors = $this->stringErrors;
                $habitantManagement = "";
                $habitantForm = false;
                if ($this->habitantArrayManagement != null) {
                    $habitantManagement = $this->habitantArrayManagement;
                    $habitantForm = true;
                }
                $this->stringErrors = null;
                $this->habitantArrayManagement = null;
                require "GestioneAcquariMarini/views/_templates/header.php";
                require "GestioneAcquariMarini/views/_templates/menu.php";
                require "GestioneAcquariMarini/views/gestioneAcquari/habitants/index.php";
                require "GestioneAcquariMarini/views/_templates/footer.php";
            } else {
                header("Location:" . URL . "tankManagement");
            }
        } else {
            header("Location:" . URL);
        }
    }

    /**
     * Funzione che aggiunge un abitante sul database richiamando la funzione nel HabitantModel.
     */
    public function addHabitant(){
        $this->habitantArrayManagement = $this->getArrayHabitantByPost();
        if ($this->habitantValidation->validation($this->habitantArrayManagement)) {
            $this->habitantModel->add($this->habitantArrayManagement);
            $this->habitantArrayManagement = null;
            if($_SESSION["authentification"]){
                header("Location:" . URL . "habitantManagement/showTankHabitants/".$_SESSION["referencesTankName"]);
            }else{
                header("location: " . URL);
            }
        }else{
            $this->stringErrors = $this->habitantValidation->stringErrors;
            $this->showTankHabitants($_SESSION["referencesTankName"]);
        }
    }
    /**
     * Funzione che quando viene schiacciato il bottone modifica di un abitante riporta i dati nel form.
     */
    public function modifyHabitant($species, $sex){
        $habitant = $this->habitantModel->getAllHabitantBySpeciesAndSex($species, $sex);
        $this->habitantArrayManagement = $this->habitantModel->getHabitantByDatabase($habitant);
        $this->textButtonForm = "Modifica";
        $this->pathForm = URL . "habitantManagement/updateHabitant/" . $species . "/" . $sex;
        $this->showTankHabitants($_SESSION["referencesTankName"]);
    }
    /**
     * Funzione che modifica un abitante sul database richiamando la funzione nell'HabitantModel.
     */
    public function updateHabitant($species, $sex){
        $this->habitantArrayManagement = $this->getArrayHabitantByPost();
        $habitantByDatabase = $this->habitantModel->getHabitantByDatabase($this->habitantModel->getAllHabitantBySpeciesAndSex($species, $sex));
        if ($this->habitantValidation->validation($this->habitantArrayManagement, $habitantByDatabase["species"], $habitantByDatabase["sex"])) {
            $this->habitantModel->modify($this->habitantArrayManagement, $habitantByDatabase["species"], $habitantByDatabase["sex"]);
            if($_SESSION["authentification"]){
                header("Location:" . URL . "habitantManagement/showTankHabitants/".$_SESSION["referencesTankName"]);
            }else{
                header("location: " . URL);
            }
        } else {
            $this->textButtonForm = "Modifica";
            $this->pathForm = URL . "habitantManagement/updateHabitant/" . $species . "/" . $sex;
        }
        $this->stringErrors = $this->habitantValidation->stringErrors;
        $this->showTankHabitants($_SESSION["referencesTankName"]);
    }
    /**
     * Funzione che cancella un abitante sul database richiamando la funzione nell'HabitantModel.
     */
    public function delete($species, $sex){
        if ($_SESSION["authentification"]) {
            $this->habitantModel->delete($species, $sex);
            header("Location:" . URL . "habitantManagement/showTankHabitants/" . $_SESSION["referencesTankName"]);
        } else {
            header("Location:" . URL);
        }
    }

    /**
     * Funzione che crea un'array contenente i dati del form letti dal POST
     * @return array habitant che contiene tutti i dati del form
     */
    public function getArrayHabitantByPost(){
        $species = $this->habitantValidation->generalValidation($_POST[HABITANT_SPECIES]);
        $sex = $this->habitantValidation->generalValidation($_POST[HABITANT_SEX]);
        $type = $this->habitantValidation->generalValidation($_POST[HABITANT_TYPE]);
        $habitantNumber = $this->habitantValidation->generalValidation($_POST[HABITANT_NUMBER]);
        $habitant = array(HABITANT_SPECIES => $species, HABITANT_SEX => $sex, HABITANT_TYPE => $type, HABITANT_NUMBER => $habitantNumber);
        return $habitant;
    }
}
