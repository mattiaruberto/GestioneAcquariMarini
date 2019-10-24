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
        require "GestioneAcquariMarini/models/mailModel.php";
        $mail = new MailModel();
        $users = $this->getValidatedValues();
        $mail->sendEmailToNewUser($users[0],$users[6],$users[1],$users[2]);
        $users = $this->getValidatedValues();
        $this->usersManagementModel->add($users);
        header("Location:" . URL . "userManagement");
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
        require "GestioneAcquariMarini/controllers/validator.php";
        $validator = new Validator();
        $email = $validator->validatePrimaryKey($_POST["email"]);
        $nome = $validator->validateInt($_POST["name"]);
        $cognome = $validator->validateInt($_POST["surname"]);
        $tipo = $validator->validateInt($_POST["type"]);
        $numeroTelefonico = $validator->validateDate($_POST["phoneNumber"]);
        $cambioPassword = $validator->validateInt($_POST["passwordChange"]);
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