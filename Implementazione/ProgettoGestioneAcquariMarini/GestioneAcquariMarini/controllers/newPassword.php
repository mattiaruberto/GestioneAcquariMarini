<?php

/**
 * Classe che gestisce quando l'utente cambia la password.
 */
class NewPassword{
    /**
     * Attributo rappresentante la classe UserModel.
     */
    private $userModel;

    /**
     * Metodo costruttore che istanzia l'oggetto UserModel.
     */
    public function __construct(){
        session_start();
        require_once 'GestioneAcquariMarini/models/userModel.php';
        $this->userModel = new UserModel();
    }
    /**
     * Metodo index che fa il require di tutte le view della pagina newPassword.
     */
    public function index(){
        require 'GestioneAcquariMarini/views/_templates/header.php';
        require 'GestioneAcquariMarini/views/gestioneAcquari/login/changePassword.php';
        if(isset($_SESSION["newPasswordDifferent"]) && $_SESSION["newPasswordDifferent"]){
            echo "<p style='color: red; margin-left: 2%'>Le due password non corrispondono</p>";
            $_SESSION["newPasswordDifferent"] = false;
        }
        require 'GestioneAcquariMarini/views/_templates/footer.php';
    }

    /**
     * Funzione che cambia la password dell'utente tramite la classe UserModel.
     */
    public function changePassword(){
        if (isset($_POST['submitNewPassword']) && !empty($_POST['newPassword']) && !empty($_POST['againNewPassword'])) {
            if ($_POST['newPassword'] == $_POST['againNewPassword']) {
                $email = $_SESSION[USER_EMAIL];
                $password =  password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
                $this->userModel->insertPassword($email,$password,1);
                header("Location:" . URL . LOGIN);
            } else {
                header("Location:" . URL . NEW_PASSWORD);
            }
        }
    }
    /**
     * Funzione base che fa la validazione dell'input.
     * @param $element string da convalidare
     * @return string ritorna la stringa convalidata
     */
    private function generalValidation($element){
        $element = trim(stripslashes(htmlspecialchars($element)));
        return $element;
    }
}
?>
