<?php
class Validator
{
    public function validateInt($element)
    {
        $validElement = $this->generalValidation($element);
        return intval($validElement);
    }

    public function validatePrimaryKey($element)
    {
        $validElement = $this->generalValidation($element);

        $pattern = '/^[A-Za-z0-9_-]*$/';
        if (!preg_match($pattern, $validElement)) {
            $validElement = strval($validElement);
        }
        return $validElement;


    }

    public function validateDate($date){
        $date_arr  = explode('-', $date);
        if (count($date_arr) == 3) {
            if (checkdate($date_arr[2], $date_arr[1], $date_arr[0])) {
                return $date;
            } else {
                return "0000-00-00";
            }
        } else {
            return "0000-00-00";
        }
    }

    private function generalValidation($element)
    {
        $element = trim(stripslashes(htmlspecialchars($element)));
        return $element;
    }
}
?>
