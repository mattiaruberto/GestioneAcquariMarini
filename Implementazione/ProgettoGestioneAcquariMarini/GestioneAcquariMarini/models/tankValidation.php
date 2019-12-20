<?php

/**
 * Classe TankValidation che gestisce la convalidazione degli input per l'aggiunta e la modifica delle vasche.
 */
class TankValidation{
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
     * @param $tank array di dati dell'acquario.
     * @param null $name nome dell'acquario originario in caso fosse stato modificato.
     * @return bool valore booleano che dice se la validazione è andata a buon fine o no.
     */
    public function validation($tank, $name=null){
        $validationOK = true;
        $this->stringErrors = "";
        if ($tank[TANK_NAME] != $name || $name == null) {
            if ($this->validationFunction->validateTankName($tank[TANK_NAME]) == ValidationFunction::ALREDY_EXIST) {
                $this->stringErrors = "Il nome della vasca esiste già";
                $validationOK = false;
            } else if ($this->validationFunction->validateTankName($tank[TANK_NAME]) == ValidationFunction::INCORRECT_INPUT) {
                $this->stringErrors = "Il nome della vasca è sbagliato";
                $validationOK = false;
            }
        }
        if(!$this->validationFunction->validateInt($tank[TANK_MAGNESIUM], 0, 3000)){
            $this->stringErrors .= "<br>Il valore del magnesio è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateInt($tank[TANK_CALCIUM], 0, 1000)){
            $this->stringErrors .= "<br>Il valore del calcio è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateInt($tank[TANK_KH], 0, 20)){
            $this->stringErrors .= "<br>Il valore del kh è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateDate($tank[TANK_WATER_CHANGE])){
            $this->stringErrors .= "<br>La data è sbagliata";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateInt($tank[TANK_LITER], 0, 1000000)){
            $this->stringErrors .= "<br>Il litraggio della vasca è sbagliato";
            $validationOK = false;
        }
        return $validationOK;
    }
    /**
     * Funzione che esegue la validazione del nome della vasca.
     * @param $tankName nome della vasca.
     * @return bool valore booleano che se true la validazione è andata bene altrimenti no.
     */
    public function validateTankName($tankName){
        if ($this->validationFunction->validateTankName($tankName) == ValidationFunction::ALREDY_EXIST) {
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
