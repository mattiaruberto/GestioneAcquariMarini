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
        header("Location:" . URL . "userManagement");
    }
}
?>
