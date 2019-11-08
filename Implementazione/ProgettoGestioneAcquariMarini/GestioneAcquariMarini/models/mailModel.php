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
    }
    public function sendEmail($emailNewUser, $newPassword, $name, $surname){
        $this->mail->setFrom('gestioneacqaurimarini@gmail.com', 'Mattia Ruberto');
        $this->mail->addAddress($emailNewUser, $name." ".$surname);
        $this->mail->Subject = 'Gestione Acquari Marini';
        $this->mail->AltBody = "<b>Benvenuto ".$name." ".$surname."<b>";
        $this->mail->Body = "Il tuo account è stato creato con successo, adesso non dovrai fare altro che accedere al sito con la password di default: <br>"
            . $newPassword .
            "<br> e cambiare la password con una tua personale,<br> Cordiali saluti,<br> Mattia</p>";
        if (!$this->mail->send()) {
            echo 'Mailer Error: '. $this->mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
    }
}

?>