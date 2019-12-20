<?php

/**
 * Classe che gestisce tutto ciò che riguarda la pagina gestione utenti.
 */
class UserManagement{
    /**
     * Attributo rappresentante la classe UserModel
     */
    private $userModel;
    /**
     * Attributo rappresentante la classe UserValidation
     */
    private $userValidation;
    /**
     * Attributo rappresentante la classe MailModel
     */
    private $mailModel;
    /**
     * Attributo rappresentante l'array dei dati dell'utente.
     */
    private $arrayUser = null;
    /**
     * Metodo costruttore che istanzia le due classi.
     */
    public function __construct(){
        session_start();
        require_once "GestioneAcquariMarini/models/userModel.php";
        require_once "GestioneAcquariMarini/models/userValidation.php";
        require "GestioneAcquariMarini/models/mailModel.php";
        $this->userModel = new userModel();
        $this->userValidation = new UserValidation();
        $this->mailModel = new MailModel();
    }
    /**
     * Funzione index che fa il require della pagina gestione utenti di tutte le view.
     */
    public function index(){
        if($_SESSION["authentification"] == true){
            if($_SESSION["type"] == "Admin") {
                $users = $this->userModel->getAll();
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
    /**
     * Funzione che prepara la pagina del form alla modifica o all'aggiunta riempendo i campi nel caso della mdoifica o
     * no nel caso dell'aggiunta.
     * @param $pageInformation array contenente le informazioni della pagina da impostare.
     */
    public function requirePageForm($pageInformation){
        if($_SESSION["authentification"]) {
            $title = $pageInformation[PAGE_TITLE];
            $nameButton = $pageInformation[NAME_BUTTON];
            $path = $pageInformation[PATH_BUTTON];
            $stringErrors = null;
            $email = null;
            if (count($pageInformation) >= 4) {
                $stringErrors = $pageInformation[ERRORS_STRING];
            }
            if (count($pageInformation) >= 5) {
                $email = $pageInformation[FORM_BENCHMARK_NAME];
            }
            if ($this->arrayUser != null) {
                $userEmail = $this->arrayUser[USER_EMAIL];
                $userName = $this->arrayUser[USER_NAME];
                $userSurname = $this->arrayUser[USER_SURNAME];
                $userType = $this->arrayUser[USER_TYPE];
                $userPhoneNumber = $this->arrayUser[USER_PHONE_NUMBER];
                $userPasswordChange = $this->arrayUser[USER_PASSWORD_CHANGE];
            } else if ($email != null) {
                $tankToModify = $this->userModel->getUserByEmail($email);
                $userEmail = $tankToModify[0][DB_USER_EMAIL];
                $userName = $tankToModify[0][DB_USER_NAME];
                $userSurname = $tankToModify[0][DB_USER_SURNAME];
                $userType = $tankToModify[0][DB_USER_TYPE];
                $userPhoneNumber = $tankToModify[0][DB_USER_PHONE_NUMBER];
                $userPasswordChange = $tankToModify[0][DB_USER_PASSWORD_CHANGE];
            }
            require "GestioneAcquariMarini/views/_templates/header.php";
            require "GestioneAcquariMarini/views/_templates/menu.php";
            require "GestioneAcquariMarini/views/gestioneAcquari/user/userManagement.php";
            require "GestioneAcquariMarini/views/_templates/footer.php";
        }else{
            header("Location:".URL);
        }
    }
    /**
     * Funzione che cancella l'utente dal database.
     * @param $email email dell'utente da cancellare.
     */
    public function delete($email){
        if($_SESSION["authentification"] == true){
            $this->userModel->delete($email);
            header("Location:" . URL . "userManagement");
        }else{
            header("Location:".URL);
        }
    }
    /**
     * Funzione che ti porta la form per l'aggiunta.
     */
    public function formAddUser(){
        $stringErrors = $this->userValidation->stringErrors;
        $path = URL."userManagement/addUser";
        $pageInformation = array("Aggiungi utente", "Aggiungi", $path);
        $this->requirePageForm($pageInformation);
    }
    /**
     * Funzione che aggiunge l'utente sul databse tramite la funzione della classe UserModel.
     */
    public function addUser(){
        $this->arrayUser = $this->getUserArray();
        $stringErrors = "";
        if($this->userValidation->validation($this->arrayUser, null)){
            if($this->mailModel->emailNewUser($this->arrayUser[USER_EMAIL], $this->arrayUser[USER_PASSWORD], $this->arrayUser[USER_NAME], $this->arrayUser[USER_SURNAME])) {
                $this->arrayUser[USER_PASSWORD] = password_hash($this->arrayUser[USER_PASSWORD], PASSWORD_DEFAULT);
                $this->userModel->add($this->arrayUser);
                $this->arrayUser = null;
                if($_SESSION["authentification"] == true){
                    header("Location:" . URL . "userManagement");
                }else{
                    header("Location:".URL);
                }
            }
            $stringErrors .= "L'email non esiste<br>";
        }
        $stringErrors .= $this->userValidation->stringErrors;
        $path = URL."userManagement/addUser";
        $pageInformation = array("Aggiungi utente", "Aggiungi", $path, $stringErrors);
        $this->requirePageForm($pageInformation);
    }
    /**
     * Funzione che ti porta al form per la modifica.
     * @param $email email dell'utente da mdoficare.
     */
    public function formModifyUser($email){
        $path = URL . "userManagement/modifyUser/".$email;
        $stringErrors = $this->userValidation->stringErrors;
        $pageInformation = array("Modifica utente", "Modifica", $path, $stringErrors, $email);
        $this->requirePageForm($pageInformation);
    }
    /**
     * Funzione che modifica la vasca che si vuole modificare.
     * @param $email email dell'utente da mdoficare.
     */
    public function modifyUser($email){
        $stringErrors = "";
        $path = URL . "userManagement/modifyUser/".$email;
        $this->arrayUser = $this->getUserArray();
        if($_SESSION["authentification"] == true){
            if($this->userValidation->validation($this->arrayUser, $email)){
                if($email != $this->arrayUser[USER_EMAIL]){
                    if($this->mailModel->emailModifyUser($this->arrayUser[USER_EMAIL])){
                        $this->userModel->add($this->arrayUser);
                        $this->arrayUser = null;
                        header("Location:" . URL . "userManagement");
                    }
                    $stringErrors .= "L'email non esiste<br>";
                }else{
                    $this->userModel->modify($this->arrayUser, $email);
                    $this->arrayTank = null;
                    header("Location:" . URL . "userManagement");
                }
            }
            $stringErrors .= $this->userValidation->stringErrors;
            $pageInformation = array("Modifica utente", "Modifica", $path, $stringErrors, $email);
            $this->requirePageForm($pageInformation);
        }else{
            header("Location:".URL);
        }
    }
    /**
     * Funzione che ritorna l'array ricavato dal form tramite il post.
     * @return array tank contenente i dati ricavati dal form tramite il post.
     */
    private function getUserArray(){
        $email = $this->userValidation->generalValidation($_POST[USER_EMAIL]);
        $name = $this->userValidation->generalValidation($_POST[USER_NAME]);
        $surname = $this->userValidation->generalValidation($_POST[USER_SURNAME]);
        $type = $this->userValidation->generalValidation($_POST[USER_TYPE]);
        $phoneNumber = $this->userValidation->generalValidation($_POST[USER_PHONE_NUMBER]);
        $passwordChange = $this->userValidation->generalValidation($_POST[USER_PASSWORD_CHANGE]);
        $password = $this->userModel->generetaRandomPassword();
        $users = array(USER_EMAIL=>$email,USER_NAME=>$name,USER_SURNAME=>$surname,USER_TYPE=>$type,USER_PHONE_NUMBER=>$phoneNumber,USER_PASSWORD_CHANGE=>$passwordChange, USER_PASSWORD=>$password);
        return $users;
    }
}