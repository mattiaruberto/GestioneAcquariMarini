<?php

class HabitantValidation
{
    private $validationFunction;
    public $stringErrors = null;

    public function __construct()
    {
        require_once "GestioneAcquariMarini/libs/ValidationFunction/validationFunction.php";
        $this->validationFunction = new ValidationFunction();
    }

    public function validation($habitant, $species, $sex){
        $validationOK = true;
        $this->stringErrors = "";
        if (!$this->validationFunction->validateSex($habitant["sex"])) {
            $this->stringErrors = "Il genere dell'abitante è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateSpeciesHabitant($habitant["species"])){
            $this->stringErrors = "Il valore inserito nel campo specie è sbagliato";
            $validationOK = false;
        }
        if($validationOK && ($species != null || $sex != null) && ($habitant["species"] != $species || $habitant["sex"] != $sex)){
            if(!$this->validationFunction->validatePrimaryKeysHabitant($habitant["species"],$habitant["sex"])){
                $this->stringErrors = "La specie e il genere inseriti esistono già";
                $validationOK = false;
            }
        }
        if(!$this->validationFunction->validateString($habitant["type"])){
            $this->stringErrors .= "<br>Il tipo di abitante inserito è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateInt($habitant["habitantNumber"], 1, 10000)){
            $this->stringErrors .= "<br>Il numero di habitanti è sbagliato";
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