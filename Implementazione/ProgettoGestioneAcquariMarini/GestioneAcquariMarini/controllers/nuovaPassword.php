<?php
class NuovaPassword
{
    //funzione per controllare gli accessi
    public function index(){
        session_start();
        require 'GestioneAcquariMarini/views/_templates/header.php';
        require 'GestioneAcquariMarini/views/gestioneAcquari/nuovaPassword.php';
        if($_SESSION["errore"] == "1"){
            echo "<p style='color: red; margin-left: 2%'>Le due password non corrispondono</p>";
        }
        require 'GestioneAcquariMarini/views/_templates/footer.php';
    }

    public function newPassword()
    {
        session_start();
        if (isset($_POST['submitNewPassword'])) {
            $password = hash('sha256', $_POST['newPassword']);
            $againPassword = hash('sha256', $_POST['againNewPassword']);

            if ($password == $againPassword) {
                require_once 'GestioneAcquariMarini/models/nuovapasswordmodel.php';
                $nuovaPasswordModel = new NuovaPasswordModel();
                $email = $_SESSION["email"];
                $nuovaPasswordModel->insertPassword($email,$password);

                header("Location:" . URL . "login");
            } else {
                $_SESSION["errorePassword"] = 1;
            }
        }
    }
}
?>
