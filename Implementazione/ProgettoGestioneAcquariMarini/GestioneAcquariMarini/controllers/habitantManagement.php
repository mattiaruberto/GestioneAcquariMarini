<?php
class habitantManagement{

    private $connection;
    public function __construct(){
        require_once "GestioneAcquariMarini/models/habitantModel.php";
        $this->habitantModel = new HabitantModel();
        session_start();
    }

    public function index(){
        if($_SESSION["authentification"] == true){
            $habitants = $this->habitantModel->getAll();
            $nameButton = "Aggiungi";
            require "GestioneAcquariMarini/views/_templates/header.php";
            require "GestioneAcquariMarini/views/_templates/menu.php";
            require "GestioneAcquariMarini/views/gestioneAcquari/habitants/index.php";
            require "GestioneAcquariMarini/views/_templates/footer.php";
        }else{
            header("Location:".URL);
        }
    }
}