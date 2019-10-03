<?php
class Menu{
    public function logout(){
        session_start();
        session_destroy();
        header("location: " . URL);
    }

    public function gestioneVasche(){
        echo "a";
        header("Location:" . URL . "gestioneVasche");
    }

    public function riassuntiva(){
        echo "a";
        header("Location:" . URL . "riassuntiva");
    }
}
?>
