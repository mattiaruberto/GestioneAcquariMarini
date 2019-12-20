<?php
/**
 * Classe HabitantValidation che gestisce la convalidazione degli input per l'aggiunta e la modifica dell'abitante.
 */
class HabitantValidation{
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
     * @param $habitant array di dati dell'abitante da convalidare.
     * @param null $species specie dell'abitante originaria in caso fosse stata modificata
     * @param null $sex sesso dell'abitante originaria in caso fosse stata modificata
     * @return bool valore booleano che dice se la validazione è andata a buon fine o no.
     */
    public function validation($habitant, $species = null, $sex = null){
        $validationOK = true;
        $this->stringErrors = "";
        if (!$this->validationFunction->validateSex($habitant[HABITANT_SEX])) {
            $this->stringErrors = "Il genere dell'abitante è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateSpeciesHabitant($habitant[HABITANT_SPECIES])){
            $this->stringErrors = "Il valore inserito nel campo specie è sbagliato";
            $validationOK = false;
        }
        if($validationOK && ($species != null || $sex != null) && ($habitant[HABITANT_SPECIES] != $species || $habitant[HABITANT_SEX] != $sex)){
            if(!$this->validationFunction->validatePrimaryKeysHabitant($habitant[HABITANT_SPECIES],$habitant[HABITANT_SEX])){
                $this->stringErrors = "La specie e il genere inseriti esistono già";
                $validationOK = false;
            }
        }
        if(!$this->validationFunction->validateHabitantType($habitant[HABITANT_TYPE])){
            $this->stringErrors .= "<br>Il tipo di abitante inserito è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateInt($habitant[HABITANT_NUMBER], 1, 10000)){
            $this->stringErrors .= "<br>Il numero di habitanti è sbagliato";
            $validationOK = false;
        }
        return $validationOK;
    }
    /**
     * Funzione base che fa la validazione dell'input.
     * @param $element string da convalidare
     * @return string ritorna la stringa convalidata
     */
    public function generalValidation($element){
        return $this->validationFunction->generalValidation($element);
    }
}