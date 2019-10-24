<?php
class passwordModel
{
    private $connAccess;
    private $statement;

    public function __construct()
    {
        require_once "database.php";
        $this->connAccess = new Database('gestioneacquarimarini');
    }

    public function insertPassword($email, $password, $changePassword)
    {
        $selectAccesso = "UPDATE utente SET cambioPassword=:changePassword, password=:password WHERE (email=:email)";
        $this->statement = $this->connAccess->prepare($selectAccesso);

        //inserisco i parametri
        $this->statement->bindParam(':password', $password, PDO::PARAM_STR);
        $this->statement->bindParam(':email', $email, PDO::PARAM_STR);
        $this->statement->bindParam(':changePassword', $changePassword, PDO::PARAM_STR);

        $this->statement->execute();
    }
}
?>