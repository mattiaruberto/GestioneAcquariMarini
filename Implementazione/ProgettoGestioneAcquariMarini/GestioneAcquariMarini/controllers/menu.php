<?php
class Menu
{
    public function logout(){
        session_start();
        session_destroy();
        header("location: " . URL);
    }

    public function tankManagement(){
        header("Location:" . URL . "tankManagement");
    }

    public function home(){
        header("Location:" . URL . "home");
    }

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