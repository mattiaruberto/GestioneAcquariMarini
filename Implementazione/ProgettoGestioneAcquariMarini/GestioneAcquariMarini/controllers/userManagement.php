<?php

class UserManagement
{
    private $usersManagementModel;
    private $userValidationModel;
    private $mailModel;
    private $arrayUser = null;

    public function __construct(){
        session_start();
        require_once "GestioneAcquariMarini/models/userModel.php";
        require_once "GestioneAcquariMarini/models/userValidation.php";
        require "GestioneAcquariMarini/models/mailModel.php";
        $this->usersManagementModel = new userModel();
        $this->userValidationModel = new UserValidation();
        $this->mailModel = new MailModel();
    }

    public function index(){
        if($_SESSION["authentification"] == true){
            if($_SESSION["type"] == "Admin") {
                $users = $this->usersManagementModel->getAll();
                require_once "GestioneAcquariMarini/models/tankModel.php";
                require "GestioneAcquariMarini/views/_templates/header.php";
                require "GestioneAcquariMarini/views/_templates/menu.php";
                require "GestioneAcquariMarini/views/gestioneAcquari/user/index.php";
                require "GestioneAcquariMarini/views/_templates/footer.php";
            }else{
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }else{
            header("Location:".URL);
        }
    }

    public function requirePageForm($pageInformation){
        $title = $pageInformation[0];
        $nameButton = $pageInformation[1];
        $path = $pageInformation[2];
        $stringErrors = $pageInformation[3];
        $email = null;
        if(count($pageInformation) > 4){
            $email = $pageInformation[4];
        }
        if($this->arrayUser!=null){
            $userEmail = $this->arrayUser["email"];
            $userName = $this->arrayUser["name"];
            $userSurname = $this->arrayUser["surname"];
            $userType = $this->arrayUser["type"];
            $userPhoneNumber = $this->arrayUser["phoneNumber"];
            $userPasswordChange = $this->arrayUser["passwordChange"];
        }else if($email != null){
            $tankToModify = $this->usersManagementModel->getAllUserInformation($email);
            $userEmail = $tankToModify[0]["email"];
            $userName = $tankToModify[0]["nome"];
            $userSurname = $tankToModify[0]["cognome"];
            $userType = $tankToModify[0]["tipo"];
            $userPhoneNumber = $tankToModify[0]["numeroTelefonico"];
            $userPasswordChange = $tankToModify[0]["cambioPassword"];
        }
        require "GestioneAcquariMarini/views/_templates/header.php";
        require "GestioneAcquariMarini/views/_templates/menu.php";
        require "GestioneAcquariMarini/views/gestioneAcquari/user/userManagement.php";
        require "GestioneAcquariMarini/views/_templates/footer.php";
    }

    public function delete($email){
        $this->usersManagementModel->delete($email);
        header("Location:" . URL . "userManagement");
    }

    public function formAddUser(){
        if($_SESSION["authentification"] == true){
            $stringErrors = $this->userValidationModel->stringErrors;
            $path = URL."userManagement/addUser";
            $pageInformation = array("Aggiungi utente", "Aggiungi", $path, $stringErrors);
            $this->requirePageForm($pageInformation);
        }else{
            header("Location:".URL);
        }
    }

    public function addUser(){
        $this->arrayUser = $this->getUserArray();
        $stringErrors = "";
        if($this->userValidationModel->validation($this->arrayUser, null)){
            if($this->sendEmailToNewUser($this->arrayUser['email'], $this->arrayUser['password'], $this->arrayUser['name'], $this->arrayUser['surname'])) {
                $this->arrayUser['password'] = password_hash($this->arrayUser['password'], PASSWORD_DEFAULT);
                $this->usersManagementModel->add($this->arrayUser);
                $this->arrayUser = null;
                header("Location:" . URL . "userManagement");
            }
            $stringErrors .= "L'email non esiste<br>";
        }
        $stringErrors .= $this->userValidationModel->stringErrors;
        $path = URL."userManagement/addUser";
        $pageInformation = array("Aggiungi utente", "Aggiungi", $path, $stringErrors);
        $this->requirePageForm($pageInformation);
    }

    public function formModifyUser($email)
    {
        if ($_SESSION["authentification"] == true) {
            $path = URL . "userManagement/modifyUser/".$email;
            $stringErrors = $this->userValidationModel->stringErrors;
            $pageInformation = array("Modifica utente", "Modifica", $path, $stringErrors, $email);
            $this->requirePageForm($pageInformation);
        } else {
            header("Location:" . URL);
        }
    }

    public function modifyUser($email){
        $this->arrayUser = $this->getUserArray();
        if($this->userValidationModel->validation($this->arrayUser, $email)){
            if($email != $this->arrayUser['email']){
                if($this->confirmChangementEmail($this->arrayUser['email'])){
                    $this->usersManagementModel->add($this->arrayUser);
                    $this->arrayUser = null;
                    header("Location:" . URL . "userManagement");
                }else{
                    $path = URL . "userManagement/modifyUser/".$email;
                    $stringErrors = "L'email non esiste<br>".$this->userValidationModel->stringErrors;
                    $pageInformation = array("Modifica utente", "Modifica", $path, $stringErrors, $email);
                    $this->requirePageForm($pageInformation);
                }
            }else{
                $this->usersManagementModel->modify($this->arrayUser, $email);
                $this->arrayTank = null;
                header("Location:" . URL . "userManagement");
            }
        }else{
            $path = URL . "userManagement/modifyUser/".$email;
            $stringErrors = $this->userValidationModel->stringErrors;
            $pageInformation = array("Modifica utente", "Modifica", $path, $stringErrors, $email);
            $this->requirePageForm($pageInformation);
        }
    }

    private function getUserArray(){
        $email = $_POST["email"];
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $type = $_POST["type"];
        $phoneNumber = $_POST["phoneNumber"];
        $passwordChange = $_POST["passwordChange"];
        $password = $this->usersManagementModel->generetaRandomPassword();
        $users = array("email"=>$email,"name"=>$name,"surname"=>$surname,"type"=>$type,"phoneNumber"=>$phoneNumber,"passwordChange"=>$passwordChange, "password"=>$password);
        return $users;
    }

    public function sendEmailToNewUser($email, $name, $surname, $password){
        return $this->mailModel->emailNewUser($email, $name, $surname, $password);
    }

    public function confirmChangementEmail($email){
        return $this->mailModel->emailModifyUser($email);
    }
}

?>