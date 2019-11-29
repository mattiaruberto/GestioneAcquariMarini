<?php
session_start();
class Login
{
    private $userModel;
    private $userValidation;
    private $mailModel;

    public function __construct(){
        require_once 'GestioneAcquariMarini/models/userModel.php';
        require_once 'GestioneAcquariMarini/models/userValidation.php';
        require_once 'GestioneAcquariMarini/models/mailModel.php';
        $this->userModel = new UserModel();
        $this->userValidation = new UserValidation();
        $this->mailModel = new MailModel();
    }

    //funzione per controllare gli accessi
    public function index(){
        $email = null;
        if(isset($_SESSION['email'])){
            $email = $_SESSION['email'];
        }
        require 'GestioneAcquariMarini/views/_templates/header.php';
        require 'GestioneAcquariMarini/views/gestioneAcquari/login/index.php';
        require 'GestioneAcquariMarini/views/_templates/footer.php';
        $_SESSION['errorLogin'] = false;
    }

    public function logIn(){
        if (isset($_POST['login'])) {
            $username = $_POST['email'];
            $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $result = $this->userModel->getUserForLogin($username);
            //se trovo un elemento posso entrare
            if (count($result) > 0) {
                if(password_verify ( $_POST['password'], $result[0]["password"])) {
                    $_SESSION["authentification"] = true;
                    $_SESSION["email"] = $result[0]['email'];
                    $_SESSION["type"] = $result[0]['tipo'];
                    $_SESSION["cambioPassword"] = $result[0]['cambioPassword'];

                    if ($_SESSION["cambioPassword"] == false) {
                        header("Location:" . URL . "newPassword");
                    } else {
                        header("Location:" . URL . "home");
                    }
                }else{
                    $_SESSION['errorLogin'] = true;
                    header("Location:" . URL . "login");
                }
            }else{
                header("Location:" . URL . "login");
            }
        }
    }

    public function updatePassword($email){
        $newPasswordGenerate = $this->userModel->generetaRandomPassword();
        $passwordHash = password_hash($newPasswordGenerate, PASSWORD_DEFAULT);
        if($this->userValidation->validateEmail($email)){
            $this->userModel->updatePassword($email, $passwordHash);
            $this->mailModel->emailUpdatePassword($email, $newPasswordGenerate);
            $_SESSION["errorRequestNewPassword"] = 1;
        }else{
            $_SESSION["errorRequestNewPassword"] = 2;
        }
        header("Location:".URL."login");
    }
}
?>
