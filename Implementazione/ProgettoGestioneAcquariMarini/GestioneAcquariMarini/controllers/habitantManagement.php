<?php
session_start();
class habitantManagement{

    private $connection;
    private $referenceTankName;
    private $stringErrors;
    private $habitantModel;
    private $habitantValidation;
    private $tankValidation;
    private $habitantArrayManagement = null;
    private $textButtonForm = "Aggiungi";
    private $pathForm= URL . "habitantManagement/addHabitant";

    public function __construct(){
        require_once "GestioneAcquariMarini/models/habitantModel.php";
        require_once "GestioneAcquariMarini/models/habitantValidation.php";
        require_once "GestioneAcquariMarini/models/tankValidation.php";
        $this->habitantValidation = new HabitantValidation();
        $this->tankValidation = new TankValidation();
        $this->habitantModel = new HabitantModel();
    }

    public function index(){
        header("Location:".URL);
    }

    function showAllHabitantsTank($referenceTankName = 1){
        $path = $this->pathForm;
        if($_SESSION["authentification"] == true && strlen($referenceTankName) > 0 && $referenceTankName != 1){
            if($this->tankValidation->validateTankName($referenceTankName)) {
                $_SESSION["referencesTankName"] = $referenceTankName;
                $habitants = $this->habitantModel->getAllHabitantForTank($_SESSION["referencesTankName"]);
                $nameButton = $this->textButtonForm;
                $stringErrors = $this->stringErrors;
                $habitantManagement = "";
                $habitantForm = false;
                if($this->habitantArrayManagement != null){
                    $habitantManagement = $this->habitantArrayManagement;
                    $habitantForm = true;
                }
                $this->stringErrors=null;
                $this->habitantArrayManagement = null;
                require "GestioneAcquariMarini/views/_templates/header.php";
                require "GestioneAcquariMarini/views/_templates/menu.php";
                require "GestioneAcquariMarini/views/gestioneAcquari/habitants/index.php";
                require "GestioneAcquariMarini/views/_templates/footer.php";
            }else{
                header("Location:".URL);
            }
        }else{
            header("Location:".URL);
        }
    }

    public function addHabitant(){
        $this->habitantArrayManagement = $this->getArrayHabitantByPost();
        $habitant = $this->habitantArrayManagement;
        if($this->habitantValidation->validation($habitant, null, null)){
            $this->habitantModel->add($habitant);
            $this->habitantArrayManagement = null;
        }
        $this->stringErrors = $this->habitantValidation->stringErrors;
        $this->showAllHabitantsTank($_SESSION["referencesTankName"]);
    }

    public function modifyHabitant($species, $sex){
        $habitant = $this->habitantModel->getAllHabitantBySpeciesAndSex($species,$sex);
        $this->habitantArrayManagement = $this->getArrayHabitantByDatabase($habitant);
        $this->textButtonForm="Modifica";
        $this->pathForm=URL . "habitantManagement/updateHabitant/".$species."/".$sex;
        $this->showAllHabitantsTank($_SESSION["referencesTankName"]);
    }

    public function updateHabitant($species, $sex){
        $this->habitantArrayManagement = $this->getArrayHabitantByPost();
        $habitant = $this->habitantArrayManagement;
        $habitantByDatabase = $this->getArrayHabitantByDatabase($this->habitantModel->getAllHabitantBySpeciesAndSex($species,$sex));
        if($this->habitantValidation->validation($habitant, $habitantByDatabase["species"], $habitantByDatabase["sex"])){
            $this->habitantModel->modify($habitant, $habitantByDatabase["species"], $habitantByDatabase["sex"]);
            $this->habitantArrayManagement = null;
            $this->textButtonForm="Aggiungi";
            $this->pathForm=URL . "habitantManagement/addHabitant";
        }else{
            $this->textButtonForm="Modifica";
            $this->pathForm=URL . "habitantManagement/updateHabitant/".$species."/".$sex;
        }
        $this->stringErrors = $this->habitantValidation->stringErrors;
        $this->showAllHabitantsTank($_SESSION["referencesTankName"]);
    }

    public function delete($species, $sex){
        $this->habitantModel->delete($species, $sex);
        header("Location:".URL."habitantManagement/showAllHabitantsTank/".$_SESSION["referencesTankName"]);
    }

    public function getArrayHabitantByPost(){
            $species = $_POST["species"];
            $sex = $_POST["sex"];
            $type = $_POST["type"];
            $habitantNumber = $_POST["habitantNumber"];
            $habitant = array("species"=>$species,"sex"=>$sex,"type"=>$type,"habitantNumber"=>$habitantNumber);
            return $habitant;
    }

    public function getArrayHabitantByDatabase($habitant){
        $species = $habitant[0]["specie"];
        $sex = $habitant[0]["genere"];
        $type = $habitant[0]["tipo"];
        $habitantNumber = $habitant[0]["numero"];
        $habitant = array("species"=>$species,"sex"=>$sex,"type"=>$type,"habitantNumber"=>$habitantNumber);
        return $habitant;
    }
}