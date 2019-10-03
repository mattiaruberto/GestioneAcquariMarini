<?php

class Riassuntiva{
    public function index(){
        session_start();
        if($_SESSION["authentification"] == true){
            require_once "GestioneAcquariMarini/models/acquarimodel.php";

            $riassuntivaModel = new acquarimodel();
            $aquariums = $riassuntivaModel->getAll();

            require "GestioneAcquariMarini/views/_templates/header.php";
            require "GestioneAcquariMarini/views/_templates/menu.php";
            require "GestioneAcquariMarini/views/gestioneAcquari/riassuntiva.php";
            require "GestioneAcquariMarini/views/_templates/footer.php";
        }else{
            header("Location:".URL);
        }
    }
}

?>
