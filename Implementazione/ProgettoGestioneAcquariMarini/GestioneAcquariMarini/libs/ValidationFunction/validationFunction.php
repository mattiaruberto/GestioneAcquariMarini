<?php
class ValidationFunction{
    /**
     * Costante per identificare quando un parametro è già usato.
     */
    const ALREDY_EXIST = "alredy_exist";
    /**
     * Costante per identificare quando un parametro è sbagliato.
     */
    const INCORRECT_INPUT = "incorrect";
    /**
     * Costante per identificare quando un parametro è corretto.
     */
    const CORRECT_INPUT = "correct";
    /**
     * Costante per identificare quando il tipo di abitante è un pesce.
     */
    const FISH_TYPE = "Pesce";
    /**
     * Costante per identificare quando il tipo di abitante è un corallo.
     */
    const CORAL_TYPE = "Corallo";
    /**
     * Costante per identificare quando il tipo di abitante è un crostaceo.
     */
    const SHELLFISH_TYPE = "Crostaceo";
    /**
     * Costante per identificare quando il sesso dell'abitante è maschio.
     */
    const MALE_SEX = "M";
    /**
     * Costante per identificare quando il sesso dell'abitante è femmina.
     */
    const FEMALE_SEX = "F";
    /**
     * Costante per identificare quando il sesso dell'abitante è altro.
     */
    const OTHER_SEX = "Altro";
    /**
     * Costante per identificare quando il tipo di utente è admin.
     */
    const ADMIN_USER = "Admin";
    /**
     * Costante per identificare quando il tipo di utente è normale.
     */
    const NORMAL_USER = "User";
    /**
     * Attributo che rappresenta la classe TankModel.
     */
    private $tankModel;
    /**
     * Attributo che rappresenta la classe UserModel.
     */
    private $userModel;
    /**
     * Attributo che rappresenta la classe HabitantModel.
     */
    private $habitantModel;
    /**
     * Attributo rappresentante l'array che contiene tutti i nomi delle vasche.
     */
    private $allNameTank;
    /**
     * Attributo rappresentante l'array che contiene tutte l'emal delle vasche.
     */
    private $allEmailUsers;
    /**
     * Attributo rappresentante l'array che contiene tutti gli abitanti.
     */
    private $allHabitants;
    /**
     * Meodo costruttore che istanzia le classi e ricava i valori degli array.
     */
    public function __construct(){
        require_once "GestioneAcquariMarini/models/tankModel.php";
        require_once "GestioneAcquariMarini/models/userModel.php";
        require_once "GestioneAcquariMarini/models/habitantModel.php";
        $this->tankModel = new TankModel();
        $this->userModel = new UserModel();
        $this->habitantModel = new HabitantModel();
        $this->allNameTank = $this->tankModel->getAllTankName();
        $this->allEmailUsers = $this->userModel->getAllEmail();
    }
    /**
     * Validazione dei numeri interi
     * @param $number valore da validare
     * @param $min valore minimo
     * @param $max valore massimo
     * @return bool valore di ritorno booleano
     */
    public function validateInt($number, $min, $max){
        if(is_numeric($number) && $number >= $min && $number <= $max){
            return true;
        }else{
            return false;
        }
    }
    /**
     * Funzione che esegue la convalida del nome dell'acquario.
     * @param $tankName stringa da convalidare
     * @return string costante rappresentante il tipo di risultato.
     */
    public function validateTankName($tankName)
    {
        $validElement = $this->generalValidation($tankName);
        $pattern = '/^[A-Za-z0-9_-]+$/';
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

    /**
     * Funzione che convalida la specie dell'abitante.
     * @param $species parametro da convalidare.
     * @return bool varibile booleana da ritornare.
     */
    public function validateSpeciesHabitant($species){
        $validElement = $this->generalValidation($species);
        $pattern = '/^[A-Za-z_-]+$/';
        if (preg_match($pattern, $validElement) && strlen($validElement) > 0 && strlen($validElement) <= 45) {
            return true;
        }
        return false;
    }

    /**
     * Validazione della primary key dell'abitante.
     * @param $species specie dell'abitante.
     * @param $sex sesso dell'abitante.
     * @return bool varibile booleana da ritornare.
     */
    public function validatePrimaryKeysHabitant($species, $sex){
        $this->allHabitants = $this->habitantModel->getAllHabitantBySpeciesAndSex($species, $sex);
        if(count($this->allHabitants) > 0){
            return false;
        }
        return true;
    }

    /**
     * Validazione dell'email
     * @param $email email dell'utente.
     * @return string valore rappresentante il risultato tramite costante.
     */
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

    /**
     * Funzione che effettua la validazione della data.
     * @param $stringDate data da convalidare sottoforma di stringa.
     * @return bool varibile booleana da ritornare.
     */
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
    /**
     * Funzione che esegue la validazione del numero di telefono.
     * @param $phoneNumber numero di telefono da convalidare.
     * @return bool varibile booleana da ritornare.
     */
    public function validatePhoneNumber($phoneNumber){
        $validElement = $this->generalValidation($phoneNumber);
        $pattern = '/^[0-9\s+#]+$/';
        if (strlen($phoneNumber) > 0 && strlen($phoneNumber) <= 45 && preg_match($pattern, $validElement)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Funzione che esegue la convalidazione delle stringhe.
     * @param $string stringa da convalidare.
     * @return bool varibile booleana da ritornare.
     */
    public function validateString($string){
        $validElement = $this->generalValidation($string);
        $pattern = '/^[a-zèéëàáäìíòöóüùú\s]*$/i';

        if (strlen($validElement) > 0 && strlen($validElement) <= 45 && preg_match($pattern, $validElement)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Validazione dei permessi dell'utente
     * @param $permission permesso da convalidare
     * @return bool varibile booleana da ritornare.
     */
    public function validatePermission($permission){
        if($permission == self::NORMAL_USER || $permission == self::ADMIN_USER){
            return true;
        }else{
            return false;
        }
    }
    /**
     * Funzione che controlla che il parametro inserito per dire se la password da cambiare è corretto.
     * @param $passowrdToChange valore inserito per la password da cambiare.
     * @return bool varibile booleana da ritornare.
     */
    public function validatePasswordToChange($passowrdToChange)
    {
        if ($passowrdToChange == TOCHANGEPASSWORD || $passowrdToChange == NOTCHANGEPASSWORD) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Validazione del genere dell'abitante.
     * @param $sex sesso dell'abitante.
     * @return bool varibile booleana da ritornare.
     */
    public function validateSex($sex){
        if ($sex == self::MALE_SEX || $sex == self::FEMALE_SEX || $sex == self::OTHER_SEX) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Funzione che esegue la validazione del tipo di abitante
     * @param $habitantType tipo di abitante
     * @return bool varibile booleana da ritornare.
     */
    public function validateHabitantType($habitantType)
    {
        if ($habitantType == self::SHELLFISH_TYPE || $habitantType == self::FISH_TYPE || $habitantType == self::CORAL_TYPE) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Funzione che prende un'array multidimensionale e ne ritorna uno normale.
     * @param $arrayMultidimensional array multidimensionale.
     * @return array array normale.
     */
    private function multidimensionalArrayToNormalArray($arrayMultidimensional){
        $result = array();
        foreach ($arrayMultidimensional as $row) {
            foreach ($row as $param){
                $result[] = strtolower($param);
            }
        }
        return $result;
    }
    /**
     * Funzione base che fa la validazione dell'input.
     * @param $element string da convalidare
     * @return string ritorna la stringa convalidata
     */
    public function generalValidation($element){
        $element = trim(stripslashes(htmlspecialchars($element)));
        return $element;
    }
}
?>