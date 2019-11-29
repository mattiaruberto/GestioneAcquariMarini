<?php
class UserModel
{
    private $connAccess;
    private $statement;

    public function __construct(){
        require_once "database.php";
        $this->connAccess = new Database('gestioneacquarimarini');
    }

    public function getAll(){
        $selectUser = "select email,nome,cognome,tipo,numeroTelefonico,cambioPassword from Utente";
        $result = $this->executeAndFetchStatement($selectUser);
        return $result;
    }

    public function getAllEmail(){
        $selectUser = "select email from utente";
        $allEmail = $this->executeAndFetchStatement($selectUser);
        return $allEmail;
    }

    public function getAllUserInformation($email){
        $selectUser = "select * from utente WHERE email=:email";
        $this->statement = $this->connAccess->prepare($selectUser);
        $this->statement->bindParam(':email', $email, PDO::PARAM_STR);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserForLogin($email){
        $selectAccess = "select email ,password, tipo, cambioPassword from utente WHERE email=:email";
        $this->statement = $this->connAccess->prepare($selectAccess);
        $this->statement->bindParam(':email', $email, PDO::PARAM_STR);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function modify($user, $email){
        $modifyUser = "UPDATE utente SET email=:email,nome=:name,cognome=:surname,tipo=:type,numeroTelefonico=:phoneNumber,cambioPassword=:passwordChange WHERE email=:originalEmail";
        $this->statement = $this->connAccess->prepare($modifyUser);
        if($user['passwordChange'] == "Da cambiare"){
            $passwordChange = 0;
        }else{
            $passwordChange = 1;
        }
        $this->statement->bindParam(':originalEmail', $email , PDO::PARAM_STR);
        $this->statement->bindParam(':email', $user['email'] , PDO::PARAM_STR);
        $this->statement->bindParam(':name', $user['name'] , PDO::PARAM_STR);
        $this->statement->bindParam(':surname', $user['surname'] , PDO::PARAM_STR);
        $this->statement->bindParam(':type', $user['type'] , PDO::PARAM_STR);
        $this->statement->bindParam(':phoneNumber', $user['phoneNumber'] , PDO::PARAM_STR);
        $this->statement->bindParam(':passwordChange', $passwordChange , PDO::PARAM_STR);
        $this->statement->execute();
    }

    public function add($user){
        $addUser = "INSERT INTO utente (email,nome,cognome,tipo,numeroTelefonico,cambioPassword,password) VALUES (?,?,?,?,?,?,?)";
        if($user['passwordChange'] == "Da cambiare"){
            $passwordChange = 0;
        }else{
            $passwordChange = 1;
        }
        $this->statement = $this->connAccess->prepare($addUser);
        $this->statement->bindParam(1, $user['email']);
        $this->statement->bindParam(2, $user['name']);
        $this->statement->bindParam(3, $user['surname']);
        $this->statement->bindParam(4, $user['type']);
        $this->statement->bindParam(5, $user['phoneNumber']);
        $this->statement->bindParam(6, $passwordChange);
        $this->statement->bindParam(7, $user['password']);
        $this->statement->execute();
    }

    public function updatePassword($email,$password){
        $changePassword = 0;
        $updatePassword = "UPDATE utente SET cambioPassword=:cambioPassword, password=:password WHERE (email=:email)";
        $this->statement = $this->connAccess->prepare($updatePassword);
        $this->statement->bindParam(':cambioPassword', $changePassword, PDO::PARAM_STR);
        $this->statement->bindParam(':password', $password , PDO::PARAM_STR);
        $this->statement->bindParam(':email', $email , PDO::PARAM_STR);
        $this->statement->execute();
    }

    public function delete($email){
        $deleteUser = "DELETE FROM utente WHERE email=:email";
        $this->statement = $this->connAccess->prepare($deleteUser);
        $this->statement->bindParam(':email', $email, PDO::PARAM_STR);
        $this->statement->execute();
    }

    private function executeAndFetchStatement($select){
        $this->statement = $this->connAccess->prepare($select);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function generetaRandomPassword(){
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890?(){}[]+*%&?!';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
}
?>