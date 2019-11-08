<?php
class ValidationFunction
{
    private $allNameTank;
    private $tankModel;
    const ALREDY_EXIST = "ALREDY_EXIST";
    const INCORRECT_NAME = "INCORRECT_NAME";
    const CORRECT_NAME = "CORRECT_NAME";

    public function __construct()
    {
        require_once "tankModel.php";
        $this->tankModel = new TankModel();
        $this->allNameTank = $this->tankModel->getAllTankName();
    }

    public function validateInt($number, $min, $max)
    {
        if(is_numeric($number) && $number >= $min && $number <= $max){
            return true;
        }else{
            return false;
        }
    }

    public function validateTankName($tankName)
    {
        $validElement = $this->generalValidation($tankName);
        $pattern = '/^[A-Za-z0-9_-]*$/';
        $arrayAllNameTank = $this->multidimensionalArrayToNormalArray($this->allNameTank);

        if (preg_match($pattern, $validElement) && strlen($validElement) > 0 && strlen($validElement) <= 45) {
            if (in_array($tankName, $arrayAllNameTank)){
                return self::ALREDY_EXIST;
            }else{
                return self::CORRECT_NAME;
            }
        }else{
            return self::INCORRECT_NAME;
        }
    }

    public function validateDate($date){
        $date_arr  = explode('-', $date);
        $current_date = new DateTime();
        $dateOk = false;
        if (count($date_arr) == 3) {
            if (checkdate($date_arr[2],$date_arr[1],$date_arr[0])) {
                if ($date <= $current_date) {
                    $dateOk =  true;
                }
            }
        }
        return $dateOk;
    }

    private function generalValidation($element)
    {
        $element = trim(stripslashes(htmlspecialchars($element)));
        return $element;
    }

    private function multidimensionalArrayToNormalArray($arrayMultidimensional){
        $result = array();
        foreach ($arrayMultidimensional as $key => $value) {
            $result[] = $value["nome"];
        }
        return $result;
    }
}
?>
