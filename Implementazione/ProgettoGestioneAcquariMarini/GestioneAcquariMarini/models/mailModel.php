<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

/**
 * Classe MailModel che si occupa dell'invio delle mail.
 */
class MailModel{
    /**
     * Attributo che rappresenta l'email.
     */
    private $mail;
    /**
     * Metodo costruttore che istanzia le librerie per inviare le email e tutti i parametri dell'email.
     */
    public function __construct(){
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
        $this->mail->Username = EMAIL_AMMINISTRATORE;
        $this->mail->Password = PASSWORD_AMMINISTRATORE;
        $this->mail->setFrom(EMAIL_AMMINISTRATORE, );
        $this->mail->Subject = EMAIL_SUBJECT;
    }
    /**
     * Funzione usata per inviare un email contenente la nuova password.
     * @param $emailNewUser email di destinazione del nuovo utente
     * @param $newPassword la nuova password dell'utente
     * @param $name il nome del nuovo utente
     * @param $surname il cognome del nuovo utente
     * @return bool valore booleano rappresentante se l'email è andata buon fine o no.
     */
    public function emailNewUser($emailNewUser, $newPassword, $name, $surname){
        $this->mail->addAddress($emailNewUser, $name." ".$surname);
        $this->mail->AltBody = "<b>Benvenuto ".$name." ".$surname."<b>";
        $this->mail->Body = "Il tuo account è stato creato con successo, adesso non dovrai fare altro che accedere al sito con la password di default: <br>"
            . $newPassword .
            "<br> e cambiare la password con una tua personale,<br> Cordiali saluti,<br> Amministratore</p>";
        return $this->sendEmail();
    }
    /**
     * Funzione usata per inviare un email quando viene aggiornata l'email a un utente.
     * @param $emailNewUser email di destinazione del nuovo utente
     * @param $newPassword la nuova password dell'utente
     * @return bool valore booleano rappresentante se l'email è andata buon fine o no.
     */
    public function emailUpdatePassword($emailUser, $newPassword){
        $this->mail->addAddress($emailUser);
        $this->mail->AltBody = "<b>La tua password è stata aggiornata con successo<b>";
        $this->mail->Body = "Il tua password è stato aggiornata con successo, adesso non dovrai fare altro che accedere al sito con la password di default: <br>"
            . $newPassword .
            "<br> e cambiare la password con una tua personale,<br> Cordiali saluti,<br> Amministratore</p>";
        return $this->sendEmail();
    }
    /**
     * Funzione usata per inviare un email quando viene aggiornata l'email a un utente.
     * @param $emailNewUser email di destinazione del nuovo utente
     * @return bool valore booleano rappresentante se l'email è andata buon fine o no.
     */
    public function emailModifyUser($emailUser){
        $this->mail->addAddress($emailUser);
        $this->mail->AltBody = "<b>Conferma email<b>";
        $this->mail->Body = "La sua email è stata aggiornata con successo";
        return $this->sendEmail();
    }
    /**
     * Funzione usata per inviare un email di allerta quando i valori di una vasca sono fuori dal range.
     * @param $tankName nome della vasca.
     * @param $message messaggio da inviare.
     * @return bool valore booleano rappresentante se l'email è andata buon fine o no.
     */
    public function emailWarning($tankName, $message){
        $this->mail->addAddress("mattia.ruberto@samtrevano.ch");
        $this->mail->Subject = "Attenzione valori della vasca ".$tankName." sono fuori dal range";
        $this->mail->AltBody = "<b>Attenzione<b>";
        $this->mail->Body = $message;
        return $this->sendEmail();
    }
    /**
     * Metodo che invia l'email, se l'invio va a buon fine ritorna true altrimenti false.
     * @return bool valore booleano che rappresenta se l'email è stata inviata correttamente.
     */
    public function sendEmail(){
        if ($this->mail->send()) {
            return true;
        } else {
            return false;
        }
    }
}
?>