<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailModel
{
    private $mail;
    public function __construct()
    {
        require_once "GestioneAcquariMarini/libs/PHPMailer/PHPMailer.php";
        require_once "GestioneAcquariMarini/libs/PHPMailer/SMTP.php";
        require_once "GestioneAcquariMarini/libs/PHPMailer/Exception.php";

        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->SMTPDebug=SMTP::DEBUG_SERVER;
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Port = 587;
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'gestioneacquarimarini@gmail.com';
        $this->mail->Password = 'Jecki12345@';
        $this->mail->setFrom('gestioneacqaurimarini@gmail.com', 'Mattia Ruberto');
        $this->mail->Subject = 'Gestione Acquari Marini';
    }
    public function emailNewUser($emailNewUser, $newPassword, $name, $surname){
        $this->mail->addAddress($emailNewUser, $name." ".$surname);
        $this->mail->AltBody = "<b>Benvenuto ".$name." ".$surname."<b>";
        $this->mail->Body = "Il tuo account è stato creato con successo, adesso non dovrai fare altro che accedere al sito con la password di default: <br>"
            . $newPassword .
            "<br> e cambiare la password con una tua personale,<br> Cordiali saluti,<br> Mattia</p>";
        return $this->sendEmail();
    }
    public function emailUpdatePassword($emailUser, $newPassword){
        $this->mail->addAddress($emailUser);
        $this->mail->AltBody = "<b>La tua password è stata aggiornata con successo<b>";
        $this->mail->Body = "Il tua password è stato aggiornata con successo, adesso non dovrai fare altro che accedere al sito con la password di default: <br>"
            . $newPassword .
            "<br> e cambiare la password con una tua personale,<br> Cordiali saluti,<br> Mattia</p>";
        return $this->sendEmail();
    }
    public function emailModifyUser($emailUser){
        $this->mail->setFrom('gestioneacqaurimarini@gmail.com', 'Mattia Ruberto');
        $this->mail->addAddress($emailUser);
        $this->mail->AltBody = "<b>Conferma email<b>";
        $this->mail->Body = "La sua email è stata aggiornata con successo";
        return $this->sendEmail();
    }
    public function emailWarning($tankName, $message){
        $this->mail->addAddress("mattia.ruberto@samtrevano.ch");
        $this->mail->Subject = "Attenzione valori della vasca ".$tankName." sono fuori dal range";
        $this->mail->AltBody = "<b>Attenzione<b>";
        $this->mail->Body = $message;
        return $this->sendEmail();
    }
    public function sendEmail(){
        if ($this->mail->send()) {
            return true;
        } else {
            return false;
        }
    }
}
?>