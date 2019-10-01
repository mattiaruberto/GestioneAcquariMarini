<?php
class NuovaPasswordModel
{
    private $connAccesso;
    private $statement;

    public function __construct()
    {
        require_once "database.php";
        $this->connAccesso = new Database('gestioneacquarimarini');
    }

    public function insertPassword($email, $password)
    {
        $selectAccesso = "UPDATE utente SET passwordDefault=:password WHERE (email =:email)";
        $this->statement = $this->connAccesso->prepare($selectAccesso);

        //inserisco i parametri
        $this->statement->bindParam(':password', $password, PDO::PARAM_STR);
        $this->statement->bindParam(':email', $email, PDO::PARAM_STR);

        $this->statement->execute();
    }
}
?>