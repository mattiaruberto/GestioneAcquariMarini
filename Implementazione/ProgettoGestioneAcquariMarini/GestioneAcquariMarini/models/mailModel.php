<?php

class MailModel
{
    public function sendEmailToNewUser($emailNewUser, $newPassword, $name, $surname)
    {

        require_once "PHPMailer.php";

        $mail = new PHPMailer();

        $mail->From = 'mattia.ruberto@samtrevano.ch';
        $mail->FromName = 'Mattia Ruberto';
        $mail->addAddress($emailNewUser);     // Add a recipient

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Gestione Acquari Marini';
        $mail->Body = "<b>Benvenuto ".$name." ".$surname."<b>";
        $mail->AltBody = "Il tuo account è stato creato con successo, adesso non dovrai fare altro che accedere al sito con la password di default: <br>" . $newPassword . "<br> e cambiare la password con una tua personale,<br> Cordiali saluti,<br> Mattia</p>";

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }
}
?>