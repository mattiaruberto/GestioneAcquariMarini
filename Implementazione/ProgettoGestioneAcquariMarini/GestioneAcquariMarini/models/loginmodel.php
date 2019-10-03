<?php
class LoginModel
{
    private $connAccesso;
    private $statement;

    public function __construct()
    {
        require_once "database.php";
        $this->connAccesso = new Database('gestioneacquarimarini');
    }

    public function getUser($username, $pass)
    {
        $selectAccesso = "select email,passwordDefault,password from utente WHERE email=:email AND (password=:password OR passwordDefault=:passwordDefault)";
        $this->statement = $this->connAccesso->prepare($selectAccesso);

        //inserisco i parametri
        $this->statement->bindParam(':email', $username, PDO::PARAM_STR);
        $this->statement->bindParam(':password', $pass, PDO::PARAM_STR);
        $this->statement->bindParam(':passwordDefault', $pass, PDO::PARAM_STR);

        $this->statement->execute();

        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>