<?php
/**
 * La classe Menu gestisce tutti i bottoni del menu.
 */
class Menu{
    /**
     * Funzione che esegue il logout.
     */
    public function logout(){
        session_start();
        session_destroy();
        header("location: " . URL);
    }
    /**
     * Funzione che ti porta alla pagina gestione vasche.
     */
    public function tankManagement(){
        header("Location:" . URL . "tankManagement");
    }

    /**
     * Funzione che ti porta alla pagina riassuntiva.
     */
    public function home(){
        header("Location:" . URL . HOME);
    }

    /**
     * Funzione che ti porta alla pagina gestione utenti.
     */
    public function userManagement(){
        session_start();
        if($_SESSION["type"] == "Admin") {
            header("Location:" . URL . "userManagement");
        }else{
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
}
?>