<?php

class TankValidation
{
    private $validationFunction;
    public $stringErrors;

    public function __construct()
    {
        require_once "validationFunction.php";
        $this->validationFunction = new ValidationFunction();
    }

    public function validation($tank){
        $validationOK = true;
        $this->stringErrors = "";
        if($this->validationFunction->validateTankName($tank["tankName"]) == ValidationFunction::ALREDY_EXIST){
            $this->stringErrors = "Il nome della vasca esiste già";
            $validationOK = false;
        }else if($this->validationFunction->validateTankName($tank["tankName"]) == ValidationFunction::INCORRECT_NAME){
            $this->stringErrors = "Il nome della vasca è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateInt($tank["magnesium"], 0, 3000)){
            $this->stringErrors .= "<br>Il valore del magnesio è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateInt($tank["calcium"], 0, 1000)){
            $this->stringErrors .= "<br>Il valore del calcio è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateInt($tank["kh"], 0, 20)){
            $this->stringErrors .= "<br>Il valore del kh è sbagliato";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateDate($tank["waterChange"])){
            $this->stringErrors .= "<br>La data è sbagliata";
            $validationOK = false;
        }
        if(!$this->validationFunction->validateInt($tank["liter"], 0, 1000000)){
            $this->stringErrors .= "<br>Il litraggio della vasca è sbagliato";
            $validationOK = false;
        }
        return $validationOK;
    }
}
