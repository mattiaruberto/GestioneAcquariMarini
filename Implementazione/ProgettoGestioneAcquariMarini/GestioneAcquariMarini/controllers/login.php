<?php
session_start();

/**
 * Classe login che gestisce la pagina.
 */
class Login{
    /**
     * @var UserModel attributo rappresentante la classe UserModel
     */
    private $userModel;
    /**
     * @var UserValidation attributo rappresentante la classe UserValidation
     */
    private $userValidation;
    /**
     * @var MailModel attributo rappresentante la classe MailModel
     */
    private $mailModel;

    /**
     * Meotodo costruttore che istanzia le tre classi che abbiamo bisogno.
     */
    public function __construct(){
        require_once 'GestioneAcquariMarini/models/userModel.php';
        require_once 'GestioneAcquariMarini/models/userValidation.php';
        require_once 'GestioneAcquariMarini/models/mailModel.php';
        $this->userModel = new UserModel();
        $this->userValidation = new UserValidation();
        $this->mailModel = new MailModel();
    }

    /**
     * Funzione index che richiama i reuqire della pagina.
     */
    public function index(){
        $email = null;
        if(isset($_SESSION[USER_EMAIL])){
            $email = $_SESSION[USER_EMAIL];
        }
        require 'GestioneAcquariMarini/views/_templates/header.php';
        require 'GestioneAcquariMarini/views/gestioneAcquari/login/index.php';
        require 'GestioneAcquariMarini/views/_templates/footer.php';
        $_SESSION['errorLogin'] = false;
    }

    /**
     * Metod che effettua la convalidazione delle credenziali dell'utente quando fa il login.
     */
    public function logIn(){
        if (isset($_POST[LOGIN]) && !empty($_POST[USER_EMAIL]) && !empty($_POST[USER_PASSWORD])) {
            $email = $this->generalValidation($_POST[USER_EMAIL]);
            $user = $this->userModel->getUserByEmail($email);
            if (count($user) > 0 && password_verify ( $_POST[USER_PASSWORD], $user[0][USER_PASSWORD])) {
                $_SESSION[AUTHENTIFICATION] = true;
                $_SESSION[USER_EMAIL] = $user[0][USER_EMAIL];
                $_SESSION[USER_TYPE] = $user[0][DB_USER_TYPE];
                if ($user[0][DB_USER_PASSWORD_CHANGE] == 0 ) {
                    header("Location:" . URL . NEW_PASSWORD);
                } else {
                    header("Location:" . URL . HOME);
                }
            }else{
                $_SESSION['errorLogin'] = true;
                header("Location:" . URL . LOGIN);
            }
        }
    }

    /**
     * Meotod che effettua l'update della password quando l'utente ha dimenticato la password.
     * @param $email dell'utente che effettua il cambio password.
     */
    public function updatePassword($email){
        $newPasswordGenerate = $this->userModel->generetaRandomPassword();
        $passwordHash = password_hash($newPasswordGenerate, PASSWORD_DEFAULT);
        if($this->userValidation->validateEmail($email)){
            $this->userModel->insertPassword($email, $passwordHash, 0);
            $this->mailModel->emailUpdatePassword($email, $newPasswordGenerate);
            $_SESSION["errorRequestNewPassword"] = 1;
        }else{
            $_SESSION["errorRequestNewPassword"] = 2;
        }
        header("Location:".URL."login");
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
