<?php

/**
 * Classe che effettua il controllo dei valori della vasca.
 */
class TankValueControl{
    /**
     * Attributo rappresentante la classe MailModel.
     */
    private $mailModel;
    /**
     * Attributo rappresentante tutti gli acquari.
     */
    private $acquariums;
    /**
     * Variabile booleana utilizzata per capire se inviare l'email o meno.
     */
    private $sendEmail = false;
    /**
     * Stringa che rappresenta la password criptata per accedere al metodo.
     */
    private $password = '$2y$10$AEG07IpNe01KNOPuShvPGOf2M1fNUHX4aHU1RVhr1/5bBx4/a.FwS';
    /**
     * Metodo index che ti riporta alla pagina login.
     */
    public function index(){
        header("Location:".URL);
    }

    /**
     * Metodo costruttore che istanzia le classi e la variabile di tutte le vasche.
     */
    public function __construct(){
        require_once "GestioneAcquariMarini/models/tankModel.php";
        require_once "GestioneAcquariMarini/models/mailModel.php";
        $tankManagementModel = new TankModel();
        $this->mailModel = new MailModel();
        $this->acquariums = $tankManagementModel->getAll();
    }

    /**
     * Funzione che effettua il controllo dei valori e invia l'email se c'è qualche problema.
     * @param $password password per accedere al metodo.
     */
    public function valueControl($password){
        if(password_verify($password, password_hash("Password@1@1234", PASSWORD_DEFAULT))) {
            foreach ($this->acquariums as $tank) {
                $name = $tank[DB_TANK_NAME];
                $magnesium = $tank[DB_TANK_MAGNESIUM];
                $calcium = $tank[DB_TANK_CALCIUM];
                $kh = $tank[DB_TANK_KH];
                $message = "I valori della vasca " . $name . " non sono nel range adatto, in particolare:";

                if (!$this->checkRangeValue($magnesium, 1200, 1450)) {
                    $message .= "<br> Megnesio: " . $magnesium;
                    $this->sendEmail = true;
                }
                if (!$this->checkRangeValue($calcium, 350, 450)) {
                    $message .= "<br> Calcio: " . $calcium;
                    $this->sendEmail = true;
                }
                if (!$this->checkRangeValue($kh, 7, 11)) {
                    $message .= "<br> Kh: " . $kh;
                    $this->sendEmail = true;
                }
                if ($this->sendEmail) {
                    $this->mailModel->emailWarning($name, $message);
                }
            }
        }else{
            echo "Password sbagliata";
        }
        $this->closePage();
    }

    /**
     * Funzione che controlla se il valore è nel range.
     * @param $value valore da controllare
     * @param $min valore minimo
     * @param $max valore massimo
     * @return bool se è nel range ritorna true altrimenti false.
     */
    public function checkRangeValue($value, $min, $max){
        if($value >= $min && $value <= $max){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Funzione che chiuda la pagina una volta finito.
     */
    public function closePage(){
        echo '<script type="text/javascript">
            var win = window.open("about:blank", "_self");
            win.close();
        </script>';
    }
}