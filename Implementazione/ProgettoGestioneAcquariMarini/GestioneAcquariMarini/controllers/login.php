<?php
class Login{
    //funzione per controllare gli accessi
    public function index(){
        require 'GestioneAcquariMarini/views/_templates/header.php';
        require 'GestioneAcquariMarini/views/gestioneAcquari/login.php';
        require 'GestioneAcquariMarini/views/_templates/footer.php';
    }
    public function logIn(){
        if (isset($_POST['login'])) {
            $username = $_POST['email'];
            $pass = hash('sha256', $_POST['password']);
            require_once 'GestioneAcquariMarini/models/loginmodel.php';
            $loginModel = new LoginModel();
            $result = $loginModel->getTipo($username, $pass);
            //se trovo un elemento posso entrare
            if (count($result) > 0) {
                session_start();
                $_SESSION["errore"] = 0;
                $_SESSION["email"] = $result[0]['email'];
                $_SESSION["password"] = $result[0]['password'];
                $_SESSION["passwordDefault"] = $result[0]['passwordDefault'];

                if($_SESSION["passwordDefault"] == null){
                    header("Location:" . URL . "nuovaPassword");
                }else{
                    header("Location:" . URL . "riassuntiva");
                }
            }else{
                header("Location:" . URL . "login");
            }
        }
    }
}
?>
