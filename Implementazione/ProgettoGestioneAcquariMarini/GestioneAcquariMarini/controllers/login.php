<?php
session_start();
class Login
{
    //funzione per controllare gli accessi
    public function index(){
        require 'GestioneAcquariMarini/views/_templates/header.php';
        require 'GestioneAcquariMarini/views/gestioneAcquari/login/index.php';

        if(isset($_SESSION['loginError'])){
            echo "<p style='color: red;margin-left: 2%;'>Usernama o password sono sbagliati</p>";
        }

        require 'GestioneAcquariMarini/views/_templates/footer.php';
    }

    public function logIn(){
        if (isset($_POST['login'])) {
            $username = $_POST['email'];
            $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            require_once 'GestioneAcquariMarini/models/userModel.php';
            $userModel = new UserModel();
            $result = $userModel->getUserByEmail($username);
            //se trovo un elemento posso entrare
            if (count($result) > 0) {
                if(password_verify ( $_POST['password'], $result[0]["password"])) {
                    $_SESSION["loginError"] = false;
                    $_SESSION["errore"] = 0;
                    $_SESSION["authentification"] = true;
                    $_SESSION["email"] = $result[0]['email'];
                    $_SESSION["password"] = $result[0]['password'];
                    $_SESSION["cambioPassword"] = $result[0]['cambioPassword'];

                    if ($_SESSION["cambioPassword"] == false) {
                        header("Location:" . URL . "newPassword");
                    } else {
                        header("Location:" . URL . "home");
                    }
                }else{
                    $_SESSION["loginError"] = true;
                    header("Location:" . URL . "login");
                }
            }else{
               header("Location:" . URL . "login");
            }
        }
    }
}
?>
