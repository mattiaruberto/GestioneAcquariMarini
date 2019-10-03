<?php

class GestioneVasche{
    public function index(){
        session_start();
        if($_SESSION["authentification"] == true){
            require_once "GestioneAcquariMarini/models/acquarimodel.php";

            $gestionevaschemodel = new acquarimodel();
            $aquariums = $gestionevaschemodel->getNameLitrage();

            require "GestioneAcquariMarini/views/_templates/header.php";
            require "GestioneAcquariMarini/views/_templates/menu.php";
            require "GestioneAcquariMarini/views/gestioneAcquari/gestioneVasche.php";
            require "GestioneAcquariMarini/views/_templates/footer.php";
        }else{
            header("Location:".URL);
        }
    }

    public function delete($bowl){
        echo $bowl;
    }
}

?>