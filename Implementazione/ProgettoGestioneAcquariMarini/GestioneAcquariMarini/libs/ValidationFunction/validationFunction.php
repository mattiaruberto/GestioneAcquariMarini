<?php
class ValidationFunction
{
    private $tankModel;
    private $userModel;
    private $allNameTank;
    private $allEmailUsers;
    const ALREDY_EXIST = "alredy_exist";
    const INCORRECT_INPUT = "incorrect";
    const CORRECT_INPUT = "correct";

    public function __construct()
    {
        require_once "GestioneAcquariMarini/models/tankModel.php";
        require_once "GestioneAcquariMarini/models/userModel.php";
        $this->tankModel = new TankModel();
        $this->userModel = new UserModel();
        $this->allNameTank = $this->tankModel->getAllTankName();
        $this->allEmailUsers = $this->userModel->getAllEmail();
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
        $pattern = '/^[a-z0-9_\-]+$/';
        $arrayAllNameTank = $this->multidimensionalArrayToNormalArray($this->allNameTank);
        if (preg_match($pattern, $validElement) && strlen($validElement) > 0 && strlen($validElement) <= 45) {
            if (in_array(strtolower($tankName), $arrayAllNameTank)){
                return self::ALREDY_EXIST;
            }else{
                return self::CORRECT_INPUT;
            }
        }else{
            return self::INCORRECT_INPUT;
        }
    }

    public function validateEmail($email){
        $validElement = $this->generalValidation($email);
        $pattern = '/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
        $arrayAllEmailUser = $this->multidimensionalArrayToNormalArray($this->allEmailUsers);
        if( preg_match($pattern, $validElement)){
            if (in_array(strtolower($email), $arrayAllEmailUser)){
                return self::ALREDY_EXIST;
            }else{
                return self::CORRECT_INPUT;
            }
        }else{
            return self::INCORRECT_INPUT;
        }
    }

    public function validateDate($stringDate){
        $date_arr  = explode('-', $stringDate);
        $date = new DateTime($stringDate);
        $current_date = new DateTime();
        $dateOk = false;
        if (count($date_arr) == 3 && strlen($stringDate) == 10) {
            if (checkdate($date_arr[2],$date_arr[1],$date_arr[0])) {
                if ($date <= $current_date) {
                    $dateOk =  true;
                }
            }
        }
        return $dateOk;
    }

    public function validatePhoneNumber($phoneNumber)
    {
        $validElement = $this->generalValidation($phoneNumber);
        $pattern = '/^[0-9\s+#]+$/';
        if (strlen($phoneNumber) > 0 && strlen($phoneNumber) <= 45 && preg_match($pattern, $validElement)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateString($string){
        $validElement = $this->generalValidation($string);
        $pattern = '/^[a-zèéëàáäìíòöóüùú\s]*$/i';

        if (strlen($validElement) > 0 && strlen($validElement) <= 45 && preg_match($pattern, $validElement)) {
            return true;
        } else {
            return false;
        }
    }

    public function validatePermission($permission){
        if($permission == "User" || $permission == "Admin"){
            return true;
        }else{
            return false;
        }
    }

    public function validatePasswordToChange($passowrdToChange)
    {
        if ($passowrdToChange == TOCHANGEPASSWORD || $passowrdToChange == NOTCHANGEPASSWORD) {
            return true;
        } else {
            return false;
        }
    }

    private function multidimensionalArrayToNormalArray($arrayMultidimensional){
        $result = array();
        foreach ($arrayMultidimensional as $row) {
            foreach ($row as $key => $value) {
                $result[] = strtolower($row[$key]);
            }
        }
        return $result;
    }

    private function generalValidation($element)
    {
        $element = trim(stripslashes(htmlspecialchars($element)));
        return $element;
    }
}
?>
