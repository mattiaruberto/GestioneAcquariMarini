<?php

class tankManagement
{
    private $tankManagementModel;

    public function __construct(){
        require_once "GestioneAcquariMarini/models/tankModel.php";
        $this->tankManagementModel = new tankModel();
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
            $title = "Aggiungi vasca";
            $nameButton = "Aggiungi";
            $path = URL."tankManagement/addTank";

            require "GestioneAcquariMarini/views/_templates/header.php";
            require "GestioneAcquariMarini/views/_templates/menu.php";
            require "GestioneAcquariMarini/views/gestioneAcquari/tank/tankManagement.php";
            require "GestioneAcquariMarini/views/_templates/footer.php";
        }else{
            header("Location:".URL);
        }
    }

    public function formModifyTank($name)
    {
        session_start();
        if ($_SESSION["authentification"] == true) {
            $title = "Modifica vasca";
            $nameButton = "Modifica";
            $path = URL . "tankManagement/modifyTank/".$name;

            $tankToModify = $this->tankManagementModel->getByName($name);
            $tankName = $tankToModify[0]["nome"];
            $magnesio = $tankToModify[0]["calcio"];
            $calcio = $tankToModify[0]["magnesio"];
            $kh = $tankToModify[0]["kh"];
            $waterChange = $tankToModify[0]["ultimo_cambio_acqua"];
            $liter = $tankToModify[0]["Litri"];

            require "GestioneAcquariMarini/views/_templates/header.php";
            require "GestioneAcquariMarini/views/_templates/menu.php";
            require "GestioneAcquariMarini/views/gestioneAcquari/tank/tankManagement.php";
            require "GestioneAcquariMarini/views/_templates/footer.php";

        } else {
            header("Location:" . URL);
        }
    }

    public function modifyTank($name){
        $tank = $this->getValidatedValues();
        $this->tankManagementModel->modify($tank, $name);
        header("Location:" . URL . "tankManagement");
    }

    public function addTank(){
        $tank = $this->getValidatedValues();
        $this->tankManagementModel->add($tank);
        header("Location:" . URL . "tankManagement");
    }

    public function delete($bowl){
        $this->tankManagementModel->delete($bowl);
        header("Location:" . URL . "tankManagement");
    }

    private function getValidatedValues(){
        require "GestioneAcquariMarini/controllers/validator.php";
        $validator = new Validator();
        $name = $validator->validatePrimaryKey($_POST["tankName"]);
        $magnesio = $validator->validateInt($_POST["magnesio"]);
        $calcio = $validator->validateInt($_POST["calcio"]);
        $kh = $validator->validateInt($_POST["kh"]);
        $waterChange = $validator->validateDate($_POST["waterChange"]);
        $liter = $validator->validateInt($_POST["liter"]);

        $tank = array($name, $magnesio, $calcio, $kh, $waterChange, $liter);
        return $tank;
    }

}
?>