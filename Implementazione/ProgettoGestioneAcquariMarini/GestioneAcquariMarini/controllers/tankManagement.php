<?php

class tankManagement
{
    private $tankManagementModel = null;
    private $tankValidatioModel = null;
    private $arrayTank = null;

    public function __construct(){
        require_once "GestioneAcquariMarini/models/tankModel.php";
        require_once "GestioneAcquariMarini/models/tankValidation.php";
        $this->tankValidatioModel = new TankValidation();
        $this->tankManagementModel = new TankModel();
    }

    public function requirePageModifyForm($name){
        $title = "Modifica vasca";
        $nameButton = "Modifica";
        $path = URL . "tankManagement/modifyTank/".$name;
        $stringErrors = $this->tankValidatioModel->stringErrors;

        if($this->arrayTank!=null){
            $tankName = $this->arrayTank["tankName"];
            $calcium = $this->arrayTank["calcium"];
            $magnesium = $this->arrayTank["magnesium"];
            $kh = $this->arrayTank["kh"];
            $waterChange = $this->arrayTank["waterChange"];
            $liter = $this->arrayTank["liter"];
        }else{
            $tankToModify = $this->tankManagementModel->getByName($name);
            $tankName = $tankToModify[0]["nome"];
            $magnesium = $tankToModify[0]["calcio"];
            $calcium = $tankToModify[0]["magnesio"];
            $kh = $tankToModify[0]["kh"];
            $waterChange = $tankToModify[0]["ultimo_cambio_acqua"];
            $liter = $tankToModify[0]["Litri"];
        }

        require "GestioneAcquariMarini/views/_templates/header.php";
        require "GestioneAcquariMarini/views/_templates/menu.php";
        require "GestioneAcquariMarini/views/gestioneAcquari/tank/tankManagement.php";
        require "GestioneAcquariMarini/views/_templates/footer.php";
    }

    public function requirePageAddForm(){
        $title = "Aggiungi vasca";
        $nameButton = "Aggiungi";
        $path = URL."tankManagement/addTank";
        $stringErrors = $this->tankValidatioModel->stringErrors;

        if($this->arrayTank!=null){
            $tankName = $this->arrayTank["tankName"];
            $calcium = $this->arrayTank["calcium"];
            $magnesium = $this->arrayTank["magnesium"];
            $kh = $this->arrayTank["kh"];
            $waterChange = $this->arrayTank["waterChange"];
            $liter = $this->arrayTank["liter"];
        }

        require "GestioneAcquariMarini/views/_templates/header.php";
        require "GestioneAcquariMarini/views/_templates/menu.php";
        require "GestioneAcquariMarini/views/gestioneAcquari/tank/tankManagement.php";
        require "GestioneAcquariMarini/views/_templates/footer.php";
    }

    public function index(){
        session_start();
        if($_SESSION["authentification"] == true){
            $tankManagementModel = new tankModel();
            $aquariums = $this->tankManagementModel->getAll();

            require "GestioneAcquariMarini/views/_templates/header.php";
            require "GestioneAcquariMarini/views/_templates/menu.php";
            require "GestioneAcquariMarini/views/gestioneAcquari/tank/index.php";
            require "GestioneAcquariMarini/views/_templates/footer.php";
        }else{
            header("Location:".URL);
        }
    }

    public function formAddTank(){
        session_start();
        if($_SESSION["authentification"] == true){
            $this->requirePageAddForm();
        }else{
            header("Location:".URL);
        }
    }

    public function formModifyTank($name)
    {
        session_start();
        if ($_SESSION["authentification"] == true) {
            $this->requirePageModifyForm($name);
        } else {
            header("Location:" . URL);
        }
    }

    public function modifyTank($name){
        $this->arrayTank = $this->getTankArray();
        if($this->tankValidatioModel->validation($this->arrayTank)){
            $this->tankManagementModel->modify($this->arrayTank, $name);
            $this->arrayTank = null;
            header("Location:" . URL . "tankManagement");
        }else{
            $this->requirePageAddForm();
        }
        $tank = $this->getValidatedValues();

    }

    public function addTank(){
        $this->arrayTank = $this->getTankArray();
        if($this->tankValidatioModel->validation($this->arrayTank)){
            $this->tankManagementModel->add($this->arrayTank);
            $this->arrayTank = null;
            header("Location:" . URL . "tankManagement");
        }else{
            $this->requirePageAddForm();
        }
    }

    public function delete($bowl){
        $this->tankManagementModel->delete($bowl);
        header("Location:" . URL . "tankManagement");
    }

    private function getTankArray(){
        $name = $_POST["tankName"];
        $magnesium = $_POST["magnesium"];
        $calcium = $_POST["calcium"];
        $kh = $_POST["kh"];
        $waterChange = $_POST["waterChange"];
        $liter = $_POST["liter"];

        $tank = array("tankName"=>$name, "magnesium"=>$magnesium, "calcium"=>$calcium, "kh"=>$kh, "waterChange"=>$waterChange, "liter"=>$liter);
        return $tank;
    }

}
?>