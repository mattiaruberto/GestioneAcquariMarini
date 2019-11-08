<?php
class UserModel
{
    private $connAccess;
    private $statement;

    public function __construct()
    {
        require_once "database.php";
        $this->connAccess = new Database('gestioneacquarimarini');
    }

    public function getAll(){
        $selectUser = "select email,nome,cognome,tipo,numeroTelefonico,cambioPassword from Utente";
        $result = $this->executeAndFetchStatement($selectUser);
        return $result;
    }

    public function getUserByEmail($email)
    {
        $selectAccess = "select email ,password, cambioPassword from utente WHERE email=:email";
        $this->statement = $this->connAccess->prepare($selectAccess);

        //inserisco i parametri
        $this->statement->bindParam(':email', $email, PDO::PARAM_STR);

        $this->statement->execute();

        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function add($users){
        $addUser = "INSERT INTO utente (email,nome,cognome,tipo,numeroTelefonico,cambioPassword,password) VALUES (?,?,?,?,?,?,?)";
        $this->statement = $this->connAccess->prepare($addUser);
        $this->statement->bindParam(1, $users[0]);
        $this->statement->bindParam(2, $users[1]);
        $this->statement->bindParam(3, $users[2]);
        $this->statement->bindParam(4, $users[3]);
        $this->statement->bindParam(5, $users[4]);
        $this->statement->bindParam(6, $users[5]);
        $this->statement->bindParam(7, $users[6]);
        $this->statement->execute();
    }

    public function delete($email)
    {
        $deleteUser = "DELETE FROM utente WHERE email=:email";
        $this->statement = $this->connAccess->prepare($deleteUser);
        $this->statement->bindParam(':email', $email, PDO::PARAM_STR);
        $this->statement->execute();
    }

    private function executeAndFetchStatement($select)
    {
        $this->statement = $this->connAccess->prepare($select);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>