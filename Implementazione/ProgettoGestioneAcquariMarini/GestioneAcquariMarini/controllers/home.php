<?php

/**
 * Classe home che rappresenta la pagina riassuntiva.
 */
class Home{
    /**
     * Metodo index della pagina riassuntiva, prende tutti le vasche e le mette nella variabile che poi verrà
     * utilizzata per riempire la tabella.
     */
    public function index(){
        session_start();
        if($_SESSION["authentification"] == true){
            require_once "GestioneAcquariMarini/models/tankModel.php";

            $tankManagement = new tankModel();
            $aquariums = $tankManagement->getAll();

            require "GestioneAcquariMarini/views/_templates/header.php";
            require "GestioneAcquariMarini/views/_templates/menu.php";
            require "GestioneAcquariMarini/views/gestioneAcquari/home/index.php";
            require "GestioneAcquariMarini/views/_templates/footer.php";
        }else{
            header("Location:".URL);
        }
    }
}