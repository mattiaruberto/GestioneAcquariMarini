<?php
/**
 * Classe UserValidation che gestisce la convalidazione degli input per l'aggiunta e la modifica degli utenti.
 */
class UserValidation{
    /**
     * Attributo che rappresenta la classe ValidationFunction.
     */
    private $validationFunction;
    /**
     * Attributo che rappresenta tutti gli errori trovati.
     */
    public $stringErrors = null;
    /**
     * Metodo costruttore che istanza la classe ValidationFUnction.
     */
    public function __construct(){
        require_once "GestioneAcquariMarini/libs/ValidationFunction/validationFunction.php";
        $this->validationFunction = new ValidationFunction();
    }
    /**
     * Metodo validation che esegue la validazione con l'aiuto dei metodi della classe ValidationFunction.
     * @param $user array contenente i dati da modificare dell'utente.
     * @param $email email orginaria dell'utente in caso questa fosse stata modificata.
     * @return bool valore booleano che dice se la validazione è andata a buon fine o no.
     */
    public function validation($user, $email = null){
        $validationOK = true;
        $this->stringErrors = "";
        if ($user[USER_EMAIL] != $email || $email == null) {
            if ($this->validationFunction->validateEmail($user[USER_EMAIL]) == ValidationFunction::ALREDY_EXIST) {
                $this->stringErrors = "L'email inserita esiste già";
                $validationOK = false;
            } else if ($this->validationFunction->validateEmail($user[USER_EMAIL]) == ValidationFunction::INCORRECT_INPUT) {
                $this->stringErrors = "L'email inserita è sbagliata";
                $validationOK = false;
            }
        }
        if(!$this->validationFunction->validateString($user[USER_NAME])){
            $this->stringErrors .= "<br>Il nome inserito è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateString($user[USER_SURNAME])){
            $this->stringErrors .= "<br>Il cognome inserito è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validatePermission($user[USER_TYPE])){
            $this->stringErrors .= "<br>Il tipo di utente selezionato è sbagliato o non è stato selezionato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validatePhoneNumber($user[USER_PHONE_NUMBER])){
            $this->stringErrors .= "<br>Il numero di telefono inserito è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validatePasswordToChange($user[USER_PASSWORD_CHANGE])){
            $this->stringErrors .= "<br>Il valore per il cambio password selezionato è sbagliato o non è stato selezionato";
            $validationOK = false;
        }
        return $validationOK;
    }
    /**
     * Funzione che esegue la validazione dell'email.
     * @param $email email da validare.
     * @return bool valore booleano che se true la validazione è andata a buon fine altrimenti no.
     */
    public function validateEmail($email){
        if ($this->validationFunction->validateEmail($email) == ValidationFunction::ALREDY_EXIST) {
            return true;
        }
        return false;
    }
    /**
     * Funzione che esegue la query e fa il fetch del risultato.
     * @param $select query da eseguire.
     * @return array array contenente i risultati.
     */
    public function generalValidation($element){
        return $this->validationFunction->generalValidation($element);
    }
}
