<?php

class UserManagement
{
    private $usersManagementModel;

    public function __construct(){
        require_once "GestioneAcquariMarini/models/userModel.php";
        $this->usersManagementModel = new userModel();
    }

    public function index(){
        session_start();
        if($_SESSION["authentification"] == true){
            require_once "GestioneAcquariMarini/models/tankModel.php";

            $users = $this->usersManagementModel->getAll();

            require "GestioneAcquariMarini/views/_templates/header.php";
            require "GestioneAcquariMarini/views/_templates/menu.php";
            require "GestioneAcquariMarini/views/gestioneAcquari/user/index.php";
            require "GestioneAcquariMarini/views/_templates/footer.php";
        }else{
            header("Location:".URL);
        }
    }

    public function delete($email){
        $this->usersManagementModel->delete($email);
        header("Location:" . URL . "userManagement");
    }

    public function formAddUser(){
        session_start();
        if($_SESSION["authentification"] == true){
            $title = "Aggiungi utente";
            $nameButton = "Aggiungi";
            $path = URL."userManagement/addUser";

            require "GestioneAcquariMarini/views/_templates/header.php";
            require "GestioneAcquariMarini/views/_templates/menu.php";
            require "GestioneAcquariMarini/views/gestioneAcquari/user/userManagement.php";
            require "GestioneAcquariMarini/views/_templates/footer.php";
        }else{
            header("Location:".URL);
        }
    }

    public function addUser(){
        $users = $this->getValidatedValues();
        $this->sendEmail($users[0],$users[6], $users[1], $users[2]);
        $users[6] = password_hash($users[6], PASSWORD_DEFAULT);
        $this->usersManagementModel->add($users);
        header("Location:" . URL . "userManagement");
    }

    public function sendEmail($email, $name, $surname, $password){
        require "GestioneAcquariMarini/models/mailModel.php";
        $mail = new MailModel();
        $mail->sendEmail($email, $name, $surname, $password);
    }

    public function formModifyTank($email)
    {
        session_start();
        if ($_SESSION["authentification"] == true) {
            $title = "Modifica utente";
            $nameButton = "Modifica";
            $path = URL . "tankManagement/modifyUser/".$email;

            $tankToModify = $this->tankManagementModel->getByEmail($email);

            require "GestioneAcquariMarini/views/_templates/header.php";
            require "GestioneAcquariMarini/views/_templates/menu.php";
            require "GestioneAcquariMarini/views/gestioneAcquari/tank/tankManagement.php";
            require "GestioneAcquariMarini/views/_templates/footer.php";

        } else {
            header("Location:" . URL);
        }
    }

    private function getValidatedValues(){
        require "GestioneAcquariMarini/controllers/validationFunction.php";
        $validator = new Validator();
        $email = $_POST["email"];
        $nome = $_POST["name"];
        $cognome = $_POST["surname"];
        $tipo = $_POST["type"];
        $numeroTelefonico = $_POST["phoneNumber"];
        $cambioPassword = 0;
        $password = $this->generetaRandomPassword();

        $users = array($email,$nome,$cognome,$tipo,$numeroTelefonico,$cambioPassword,$password);
        return $users;
    }

    public function generetaRandomPassword(){
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890?(){}[]+*%&?!';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
}

?>