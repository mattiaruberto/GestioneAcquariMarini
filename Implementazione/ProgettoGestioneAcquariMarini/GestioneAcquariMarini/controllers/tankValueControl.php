<?php

class tankValueControl
{
    private $mailModel;
    private $acquariums;
    private $sendEmail = false;
    private $password = '$2y$10$AEG07IpNe01KNOPuShvPGOf2M1fNUHX4aHU1RVhr1/5bBx4/a.FwS';

    public function index(){
        header("Location:".URL);
    }

    public function __construct(){
        require_once "GestioneAcquariMarini/models/tankModel.php";
        require_once "GestioneAcquariMarini/models/mailModel.php";
        $tankManagementModel = new TankModel();
        $this->mailModel = new MailModel();
        $this->acquariums = $tankManagementModel->getAll();
    }

    public function valueControl($password){
        if(password_verify($password, password_hash("Password@1@1234", PASSWORD_DEFAULT))) {
            foreach ($this->acquariums as $tank) {
                $name = $tank["nome"];
                $magnesium = $tank["magnesio"];
                $calcium = $tank["calcio"];
                $kh = $tank["kh"];
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
                    echo "Email inviata per la vasca: ".$name;
                    echo "<br>";
                }else{
                    echo "Nessuna email inviata per la vasca: ".$name;
                }
            }
        }else{
            echo "Password sbagliata";
        }
        echo '<script type="text/javascript">
            var win = window.open("about:blank", "_self");
            win.close();
        </script>';
    }

    public function checkRangeValue($calcium, $min, $max){
        if($calcium >= $min && $calcium <= $max){
            return true;
        }else{
            return false;
        }
    }
}