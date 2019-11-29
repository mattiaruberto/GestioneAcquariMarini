<?php

class UserValidation
{
    private $validationFunction;
    public $stringErrors = null;

    public function __construct()
    {
        require_once "GestioneAcquariMarini/libs/ValidationFunction/validationFunction.php";
        $this->validationFunction = new ValidationFunction();
    }

    public function validation($user, $email){
        $validationOK = true;
        $this->stringErrors = "";
        if ($user["email"] != $email || $email == null) {
            if ($this->validationFunction->validateEmail($user["email"]) == ValidationFunction::ALREDY_EXIST) {
                $this->stringErrors = "L'email inserita esiste già";
                $validationOK = false;
            } else if ($this->validationFunction->validateEmail($user["email"]) == ValidationFunction::INCORRECT_INPUT) {
                $this->stringErrors = "L'email inserita è sbagliata";
                $validationOK = false;
            }
        }
        if(!$this->validationFunction->validateString($user["name"])){
            $this->stringErrors .= "<br>Il nome inserito è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateString($user["surname"])){
            $this->stringErrors .= "<br>Il cognome inserito è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validatePermission($user["type"])){
            $this->stringErrors .= "<br>Il tipo di utente selezionato è sbagliato o non è stato selezionato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validatePhoneNumber($user["phoneNumber"])){
            $this->stringErrors .= "<br>Il numero di telefono inserito è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validatePasswordToChange($user["passwordChange"])){
            $this->stringErrors .= "<br>Il valore per il cambio password selezionato è sbagliato o non è stato selezionato";
            $validationOK = false;
        }
        return $validationOK;
    }

    public function validateEmail($email){
        if ($this->validationFunction->validateEmail($email) == ValidationFunction::ALREDY_EXIST) {
            return true;
        }
        return false;
    }
}
