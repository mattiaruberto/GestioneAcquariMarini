<?php
/**
 * Classe UserModel che gestisce tutte le azioni sul database per gli utenti.
 */
class UserModel{
    /**
     * Attributo che rappresenta la classe database.
     */
    private $connAccess;
    /**
     * Attributo che rappresente tutto ciò che riguarda la query al database.
     */
    private $statement;
    /**
     * Metodo costruttore dove viene istanziato il database.
     */
    public function __construct(){
        require_once "database.php";
        $this->connAccess = new Database(DB_NAME);
    }
    /**
     * Metodo che ritorna tutte gli utente sul database.
     * @return array array di tutti gli utenti.
     */
    public function getAll(){
        $selectUser = "select * from Utente";
        $result = $this->executeAndFetchStatement($selectUser);
        return $result;
    }
    /**
     * Metodo che ritorna tutti le email degli utenti.
     * @return array array di tutte le email.
     */
    public function getAllEmail(){
        $selectUser = "select email from utente";
        $allEmail = $this->executeAndFetchStatement($selectUser);
        return $allEmail;
    }

    /**
     * Metodo che ritorna l'utente in base all'email.
     * @param $email email dell'utente da cercare.
     * @return array array dei dati dell'utente trovato.
     */
    public function getUserByEmail($email){
        $selectUser = "select * from utente WHERE email=:email";
        $this->statement = $this->connAccess->prepare($selectUser);
        $this->statement->bindParam(':email', $email, PDO::PARAM_STR);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * Funzione che modifica un'utente.
     * @param $user array dell'utente da modificare.
     * @param $email email originaria dell'utente in caso fosse stata modificata.
     */
    public function modify($user, $email){
        $modifyUser = "UPDATE utente SET email=:email,nome=:name,cognome=:surname,tipo=:type,numeroTelefonico=:phoneNumber,cambioPassword=:passwordChange WHERE email=:originalEmail";
        $this->statement = $this->connAccess->prepare($modifyUser);
        if($user['passwordChange'] == "Da cambiare"){
            $passwordChange = 0;
        }else{
            $passwordChange = 1;
        }
        $this->statement->bindParam(':originalEmail', $email , PDO::PARAM_STR);
        $this->statement->bindParam(':email', $user[USER_EMAIL] , PDO::PARAM_STR);
        $this->statement->bindParam(':name', $user[USER_NAME] , PDO::PARAM_STR);
        $this->statement->bindParam(':surname', $user[USER_SURNAME] , PDO::PARAM_STR);
        $this->statement->bindParam(':type', $user[USER_TYPE] , PDO::PARAM_STR);
        $this->statement->bindParam(':phoneNumber', $user[USER_PHONE_NUMBER] , PDO::PARAM_STR);
        $this->statement->bindParam(':passwordChange', $passwordChange , PDO::PARAM_STR);
        $this->statement->execute();
    }
    /**
     * Funzione che aggiunge un nuovo utente al database.
     * @param $user array di dati dell'utente da aggiungere.
     */
    public function add($user){
        $addUser = "INSERT INTO utente (email,nome,cognome,tipo,numeroTelefonico,cambioPassword,password) VALUES (?,?,?,?,?,?,?)";
        if($user['passwordChange'] == "Da cambiare"){
            $passwordChange = 0;
        }else{
            $passwordChange = 1;
        }
        $this->statement = $this->connAccess->prepare($addUser);
        $this->statement->bindParam(1, $user[USER_EMAIL]);
        $this->statement->bindParam(2, $user[USER_NAME]);
        $this->statement->bindParam(3, $user[USER_SURNAME]);
        $this->statement->bindParam(4, $user[USER_TYPE]);
        $this->statement->bindParam(5, $user[USER_PHONE_NUMBER]);
        $this->statement->bindParam(6, $passwordChange);
        $this->statement->bindParam(7, $user[USER_PASSWORD]);
        $this->statement->execute();
    }
    /**
     * Metodo che inserisce la nuova passord dopo che c'è stato un cambio.
     * @param $email email dell'utente a cui cambiare la password
     * @param $password nuova password dell'utente
     * @param $valueChangePassword valore da inserire nel database per indicar se la password è ancora da cambiare o no.
     */
    public function insertPassword($email, $password, $valueChangePassword){
        $changePassword = $valueChangePassword;
        $selectAccesso = "UPDATE utente SET cambioPassword=:changePassword, password=:password WHERE (email=:email)";
        $this->statement = $this->connAccess->prepare($selectAccesso);
        $this->statement->bindParam(':password', $password, PDO::PARAM_STR);
        $this->statement->bindParam(':email', $email, PDO::PARAM_STR);
        $this->statement->bindParam(':changePassword', $changePassword, PDO::PARAM_STR);
        $this->statement->execute();
    }
    /**
     * Metodo che cancella un'utente dal database.
     * @param $email email delll'utente da cancellare.
     */
    public function delete($email){
        $deleteUser = "DELETE FROM utente WHERE email=:email";
        $this->statement = $this->connAccess->prepare($deleteUser);
        $this->statement->bindParam(':email', $email, PDO::PARAM_STR);
        $this->statement->execute();
    }
    /**
     * Funzione che esegue la query e fa il fetch del risultato.
     * @param $select query da eseguire.
     * @return array array contenente i risultati.
     */
    private function executeAndFetchStatement($select){
        $this->statement = $this->connAccess->prepare($select);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * Funzione che genera una password casuale.
     * @return string stringa cotenente la password casuale.
     */
    public function generetaRandomPassword(){
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890?(){}[]+*%&?!';
        $pass = array();
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, strlen($alphabet) - 1);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
}
?>