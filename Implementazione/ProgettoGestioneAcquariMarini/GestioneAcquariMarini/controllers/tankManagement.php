<?php
class tankManagement
{
    private $tankManagementModel = null;
    private $tankValidatioModel = null;
    private $arrayTank = null;

    public function __construct(){
        session_start();
        require_once "GestioneAcquariMarini/models/tankModel.php";
        require_once "GestioneAcquariMarini/models/tankValidation.php";
        $this->tankValidatioModel = new TankValidation();
        $this->tankManagementModel = new TankModel();
    }

    public function requirePageForm($pageInformation){
        $title = $pageInformation[0];
        $nameButton = $pageInformation[1];
        $path = $pageInformation[2];
        $stringErrors = $pageInformation[3];
        $name = null;
        if(count($pageInformation) > 4){
            $name = $pageInformation[4];
        }
        if($this->arrayTank!=null){
            $tankName = $this->arrayTank["tankName"];
            $calcium = $this->arrayTank["calcium"];
            $magnesium = $this->arrayTank["magnesium"];
            $kh = $this->arrayTank["kh"];
            $waterChange = $this->arrayTank["waterChange"];
            $liter = $this->arrayTank["liter"];
        }else if($name != null){
            $tankToModify = $this->tankManagementModel->getByName($name);
            $tankName = $tankToModify[0]["nome"];
            $magnesium = $tankToModify[0]["calcio"];
            $calcium = $tankToModify[0]["magnesio"];
            $kh = $tankToModify[0]["kh"];
            $waterChange = $tankToModify[0]["ultimo_cambio_acqua"];
            $liter = $tankToModify[0]["litri"];
        }
        require "GestioneAcquariMarini/views/_templates/header.php";
        require "GestioneAcquariMarini/views/_templates/menu.php";
        require "GestioneAcquariMarini/views/gestioneAcquari/tank/tankManagement.php";
        require "GestioneAcquariMarini/views/_templates/footer.php";
    }

    public function index(){
        if($_SESSION["authentification"] == true){
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
        if($_SESSION["authentification"] == true){
            if($_SESSION["type"] == "Admin") {
                $stringErrors = $this->tankValidatioModel->stringErrors;
                $path = URL . "tankManagement/addTank";
                $pageInformation = array("Aggiungi vasca", "Aggiungi", $path, $stringErrors);
                $this->requirePageForm($pageInformation);
            }else{
                header("Location:" . URL . "home");
            }
        }else{
            header("Location:".URL);
        }
    }

    public function formModifyTank($name)
    {
        if ($_SESSION["authentification"] == true) {
            $path = URL . "tankManagement/modifyTank/".$name;
            $stringErrors = $this->tankValidatioModel->stringErrors;
            $pageInformation = array("Modifica vasca", "Modifica", $path, $stringErrors, $name);
            $this->requirePageForm($pageInformation);
        } else {
            header("Location:" . URL);
        }
    }

    public function modifyTank($name){
        $this->arrayTank = $this->getTankArray();
        if($this->tankValidatioModel->validation($this->arrayTank, $name)){
            $this->tankManagementModel->modify($this->arrayTank, $name);
            $this->arrayTank = null;
            header("Location:" . URL . "tankManagement");
        }else{
            $path = URL . "tankManagement/modifyTank/".$name;
            $stringErrors = $this->tankValidatioModel->stringErrors;
            $pageInformation = array("Modifica vasca", "Modifica", $path, $stringErrors, $name);
            $this->requirePageForm($pageInformation);
        }
    }

    public function addTank(){
        if($_SESSION["type"] == "Admin") {
            $this->arrayTank = $this->getTankArray();
            if ($this->tankValidatioModel->validation($this->arrayTank, null)) {
                $this->tankManagementModel->add($this->arrayTank);
                $this->arrayTank = null;
                header("Location:" . URL . "tankManagement");
            } else {
                $stringErrors = $this->tankValidatioModel->stringErrors;
                $path = URL . "tankManagement/addTank";
                $pageInformation = array("Aggiungi vasca", "Aggiungi", $path, $stringErrors);
                $this->requirePageForm($pageInformation);
            }
        }else{
            header("Location:" . URL . "home");
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