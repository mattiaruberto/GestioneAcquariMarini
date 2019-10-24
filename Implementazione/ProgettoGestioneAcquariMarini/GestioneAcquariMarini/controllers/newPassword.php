<?php
class newPassword
{
    //funzione per controllare gli accessi
    public function index(){
        session_start();
        require 'GestioneAcquariMarini/views/_templates/header.php';
        require 'GestioneAcquariMarini/views/gestioneAcquari/login/changePassword.php';
        if($_SESSION["errore"] == "1"){
            echo "<p style='color: red; margin-left: 2%'>Le due password non corrispondono</p>";
        }
        require 'GestioneAcquariMarini/views/_templates/footer.php';
    }

    public function changePassword()
    {
        session_start();
        if (isset($_POST['submitNewPassword'])) {
            if ($_POST['newPassword'] == $_POST['againNewPassword']) {
                require_once 'GestioneAcquariMarini/models/passwordModel.php';
                $newPasswordModel = new passwordModel();
                $email = $_SESSION["email"];
                $password = $pass = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
                $newPasswordModel->insertPassword($email,$password,1);

                header("Location:" . URL . "login");
            } else {
                echo "ab";
                $_SESSION["errorePassword"] = 1;
            }
        }
    }
}
?>
